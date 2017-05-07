<?php
namespace Adverts\Controllers;

use Adverts\Forms\AdForm;
use Adverts\Forms\ChangeModelForm;
use Adverts\Forms\PaymentForm;
use Adverts\Forms\PMForm;
use Adverts\Forms\SupportForm;
use Adverts\Forms\ToursForm;
use Adverts\Forms\UsersForm;
use Adverts\Forms\VipForm;
use Adverts\Forms\ExtendForm;
use Adverts\Models\Mytours;
use Adverts\Models\PrivateMessages;
use Adverts\Models\Users;
use Adverts\Models\Advertising;
use Adverts\Models\Coins;
use Adverts\Models\Gallery;
use Adverts\Models\Packages;
use Adverts\Models\Support;
use Adverts\Models\Ad;
use Adverts\Models\Country;
use Adverts\Models\City;
use Adverts\Models\Payments;
use Adverts\Models\Documents;
use Adverts\Models\Withdrawal;
use Phalcon\Image;
use Phalcon\Tag;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Http\Request;
use Adverts\Auth\Exception as AuthException;

class PrivateController extends ControllerBase
{
    public function initialize()
    {
        $user = $this->auth->getUser();
        $this->view->user = $user;
        $this->view->profileName = strtolower($user->profile->name);
        $mainLogo = $this->config->application->mainLogo;
        $mainTitle = $this->config->application->mainTitle;

        try
        {
            $sql1 = 'SELECT * FROM sites where active = "Y" order by RAND() LIMIT 6';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $sites = $data1->fetchAll();
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }

        $this->view->mainLogo = $mainLogo;
        $this->view->mainTitle = $mainTitle;
        $this->view->sites = $sites;
        $this->view->setTemplateBefore('privat');
    }

    public function indexAction()
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();

            $sql = 'SELECT count(*) as myTotal FROM mlm WHERE users_id =' . $user->id;
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $myTotal = $data->fetchAll();

            $this->view->mlm = $myTotal[0]['myTotal'];
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function bonusAction()
    {
        try
        {
            $this->persistent->conditions = null;
            $status = 'Inactive';
            $user = $this->auth->getUser();

            $sql = 'SELECT sum(r.sum) as myTotal FROM revenue r WHERE r.users_id = ' . $user->id;
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $myTotal = $data->fetchAll();

            if ($myTotal[0]['myTotal'] >= 200)
            {
                $status = 'Active';
            }

            $sql2 = 'SELECT level FROM mlm WHERE users_id =' . $user->id;
            $conn2 = $this->db;
            $data2 = $conn2->query($sql2);
            $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $data3 = $data2->fetchAll();

            $sql6 = 'SELECT m.users_id, m.parent_id, sum(r.sum) as total FROM mlm m inner join revenue r on m.users_id = r.users_id inner join users u on m.users_id = u.id where m.level in ('.$data3[0]['level'].','.$data3[0]['level'].'+1,'.$data3[0]['level'].'+2,'.$data3[0]['level'].'+3,'.$data3[0]['level'].'+4,'.$data3[0]['level'].'+5) group by m.users_id';
            $conn6 = $this->db;
            $data6 = $conn6->query($sql6);
            $data6->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $data7 = $data6->fetchAll();
            $resData = array();
            $res = 0;// array();

            foreach ($data7 as $result)
            {
                array_push($resData, array('memberId' => $result['users_id'], 'parentId' => $result['parent_id'], 'amount' => $result['total']));
            }

            $resTotal = $this->sumTotal(null, $resData, $user->id, $res);

            $myEarnings = $resTotal * 0.1;

            $sql3 = 'SELECT count(*) as docs FROM documents WHERE users_id =' . $user->id;
            $conn3 = $this->db;
            $data4 = $conn3->query($sql3);
            $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $docExists = $data4->fetchAll();

            $sql1 = 'SELECT amount FROM withdrawal WHERE users_id = '. $user->id .' and approved = "N" order by id DESC LIMIT 1';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $currWD = $data1->fetchAll();

            $withdrawal = Withdrawal::find(array(
               'users_id =' . $user->id
            ));
            $wdTotal = 0;

            foreach($withdrawal as $w){
                $wdTotal += $w->amount;
            }

            if ($currWD[0]['amount'] > 0) {
                $wdCurr = $currWD[0]['amount'];
            } else {
                $wdCurr = 0;
            }
            $myEarningsLeft = $myEarnings - $wdTotal;

            $allwithdrawal = Withdrawal::find(array(
                'users_id =' . $user->id . ' and approved = "Y"'
            ));
            $wdAllTotal = 0;

            foreach($allwithdrawal as $w){
                $wdAllTotal += $w->amount;
            }

            $wdStatus = ['Waiting request','Pending','Approved'];
            if ($wdAllTotal > 0 && $wdCurr == 0) {
                $this->view->wdStatus = $wdStatus[2];
            } elseif ($wdCurr > 0) {
                $this->view->wdStatus = $wdStatus[1];
            } else {
                $this->view->wdStatus = $wdStatus[0];
            }

            $this->view->withdraw = $user->withdraw;
            $this->view->documents = $docExists[0]['docs'];
            $this->view->status = $status;
            $this->view->myTotal = $myTotal[0]['myTotal'];
            $this->view->totRevenue = $resTotal;
            $this->view->myEarnings = $myEarnings;
            $this->view->myLeftEarnings = $myEarningsLeft;
            $this->view->wdTotal = $wdTotal;
            $this->view->wdCurrent = $wdCurr;
            $this->view->wdAll = $wdAllTotal;
            $this->view->userId = $user->id;
            $this->view->name= $user->name;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    private function sumTotal($parentId, $data, $val, $res)
    {
        for ($i = 0; $i < count($data); $i++) {
            $member = $data[$i];
            if ($member['memberId'] == $val) { $member['parentId'] = null; }
            if ($member['parentId'] === $parentId) {
                $res += $member['amount'];
                //$t = $member['amount'];
                $parentId = $member['memberId'];
                //$val = null;
                $this->sumTotal($parentId, $data, null, $res);
            }
        }

        return $res; // + $t;
    }

    public function withdrawAction()
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();

            if ($this->request->isPost())
            {
                if (!$user)
                {
                    $this->flash->error('There is an error!');
                }
                else
                {
                    $amount = $this->request->getPost('amount');
                    $dt = new \DateTime();
                    $datetime = $dt->format('Y-m-d H:i:s');

                    $sql2 = 'SELECT level FROM mlm WHERE users_id =' . $user->id;
                    $conn2 = $this->db;
                    $data2 = $conn2->query($sql2);
                    $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $data3 = $data2->fetchAll();

                    $sql6 = 'SELECT m.users_id, m.parent_id, sum(r.sum) as total FROM mlm m inner join revenue r on m.users_id = r.users_id inner join users u on m.users_id = u.id where m.level in ('.$data3[0]['level'].','.$data3[0]['level'].'+1,'.$data3[0]['level'].'+2,'.$data3[0]['level'].'+3,'.$data3[0]['level'].'+4,'.$data3[0]['level'].'+5) group by m.users_id';
                    $conn6 = $this->db;
                    $data6 = $conn6->query($sql6);
                    $data6->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $data7 = $data6->fetchAll();
                    $resData = array();
                    $res = 0;// array();

                    foreach ($data7 as $result)
                    {
                        array_push($resData, array('memberId' => $result['users_id'], 'parentId' => $result['parent_id'], 'amount' => $result['total']));
                    }

                    $resTotal = $this->sumTotal(null, $resData, $user->id, $res);

                    $myEarnings = $resTotal * 0.1;

                    $withdrawal = Withdrawal::find(array(
                        'users_id =' . $user->id
                    ));
                    $wdTotal = 0;

                    foreach($withdrawal as $w){
                        $wdTotal += $w->amount;
                    }

                    $myEarnings = $myEarnings - $wdTotal;

                    if ($amount > 0) {
                        if ($myEarnings >= $amount) {
                            $withdrawal = new Withdrawal();
                            $withdrawal->users_id = $user->id;
                            $withdrawal->amount = $amount;
                            $withdrawal->date = $datetime;

                            if ($withdrawal->save()) {
                                $this->flash->success('Your withdraw request of ' . $amount . ' EUR was successfully accepted. We will send funds to your account within 48 hours.');
                            } else {
                                $this->flash->error('Something is wrong, please repeat withdrawal request!');
                            }
                        } else {
                            $this->flash->error('Your have to enter number smaller or equal to "Earnings left".');
                        }
                    } else {
                        $this->flash->error('Your have to enter a valid positive number to make withdraw.');
                    }
                    return $this->response->redirect('private/bonus');
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function loadMlmAction()
    {
        try
        {
            $this->view->disable();

            if($this->request->isPost() == true)
            {
                if ($this->request->isAjax() == true)
                {
                    try
                    {
                        $val = $this->request->getJsonRawBody();
                        $sql1 = 'SELECT level FROM mlm WHERE users_id =' . $val;
                        $conn1 = $this->db;
                        $data2 = $conn1->query($sql1);
                        $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $data3 = $data2->fetchAll();

                        $sql = 'SELECT m.users_id, m.parent_id, m.level, sum(r.sum) as total, u.name FROM mlm m inner join revenue r on m.users_id = r.users_id inner join users u on m.users_id = u.id where m.level in ('.$data3[0]['level'].','.$data3[0]['level'].'+1,'.$data3[0]['level'].'+2,'.$data3[0]['level'].'+3,'.$data3[0]['level'].'+4,'.$data3[0]['level'].'+5) group by m.users_id';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $data1 = $data->fetchAll();
                        $resData = array();

                        foreach ($data1 as $result)
                        {
                            array_push($resData, array('memberId' => $result['users_id'], 'parentId' => $result['parent_id'], 'amount' => $result['total'], 'name' => $result['name'], 'level' => $result['level']));
                        }

                        echo json_encode($resData);
                    }
                    catch (AuthException $e)
                    {
                        $this->flash->error($e->getMessage());
                    }
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function deletemodelAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            $ads = Ad::findFirstById($idarray[1]);
            $ads->deleted = 'Y';
            $ads->update();

            return $this->response->redirect('private/managemodels');
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function activatemodelAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            $ads = Ad::findFirstById($idarray[1]);
            $ads->active = 'Y';
            $ads->update();

            return $this->response->redirect('private/managemodels');
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function deactivatemodelAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            $ads = Ad::findFirstById($idarray[1]);
            $ads->active = 'N';
            $ads->update();

            return $this->response->redirect('private/managemodels');
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function deletegalleryAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            $basedir = APP_PATH . '/public/files/id' . $idarray[2];
            unlink($basedir . '/' . $idarray[0]);

            $this->db->delete('gallery', 'id = ' . $idarray[1]);

            return $this->response->redirect('private/gallery/' . $idarray[3] . '-' . $idarray[2]);
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function documentsAction()
    {
        try {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $basepath = 'documents/';

            //check if there is any file
            if ($this->request->hasFiles() == true) {
                if (!$user) {
                    $this->flash->error('There is an error!');
                } else {
                    $uploads = $this->request->getUploadedFiles();

                    $dir = $basepath . 'id' . $user->id;
                    $i = 0;

                    if (is_dir($dir) === false) {
                        mkdir($dir);
                    }

                    foreach ($uploads as $upload) {
                        $i++;

                        if ($upload->getName() != '') {
                            $check = getimagesize($upload->getTempName());
                            $min_width = 100;
                            $min_height = 200;
                            $width = $check[0];
                            $height = $check[1];
                            $image_temp = $upload->getTempName();
                            $image_type = $upload->getType();

                            switch (strtolower($image_type)) {
                                //Create new image from file
                                case 'image/png':
                                    $image_resource = imagecreatefrompng($image_temp);
                                    break;
                                case 'image/gif':
                                    $image_resource = imagecreatefromgif($image_temp);
                                    break;
                                case 'image/jpeg':
                                case 'image/pjpeg':
                                    $image_resource = imagecreatefromjpeg($image_temp);
                                    break;
                                default:
                                    $image_resource = false;
                            }

                            if ($check !== false) {
                                if ((($width >= $min_width) && ($height >= $min_height))) {
                                    $new_canvas = imagecreatetruecolor($width, $height);

                                    $name = uniqid('_') . '_' . $user->id . '.' . strtolower($upload->getExtension());
                                    $path = $dir . '/' . strtolower($name);

                                    if (imagecopyresampled($new_canvas, $image_resource, 0, 0, 0, 0, $width, $height, $width, $height)) {
                                        header('Content-Type: image/jpeg');
                                        imagejpeg($new_canvas, $path, 90);

                                        //free up memory
                                        imagedestroy($new_canvas);
                                        imagedestroy($image_resource);
                                    }

                                    $docs = new Documents();
                                    $docs->users_id = $user->id;
                                    $docs->path = $name;

                                    if (!$docs->save()) {
                                        foreach ($docs->getMessages() as $message) {
                                            $this->flash->error($message);
                                        }
                                    }

                                    $this->flash->success('You have successfully uploaded document. We will notify you of successful proof in 48 hours.');
                                    $this->response->redirect('private/bonus');
                                } else {
                                    $this->flash->error('Upload photo ' . $i . ' - photo must be larger or equal then 200x100 px!');
                                    $this->response->redirect('private/bonus');
                                }
                            } else {
                                $this->flash->error('File is not an image ' . $check['mime'] . '!');
                                $this->response->redirect('private/bonus');
                            }
                        }
                    }
                }
            }
        }
        catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function galleryAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();
            $idarray = explode('-', $param);

            $ads = Ad::findFirstById($idarray[1]);
            $basepath = 'files/';
            $watermark_path = 'img/';

            $this->view->ads = $ads;
            $this->view->c = count($ads->gallery);

            //check if there is any file
            if ($this->request->hasFiles() == true)
            {
                $uploads = $this->request->getUploadedFiles();
                //$isUploaded = false;

                $dir = $basepath . 'id' . $ads->id;
                $i = 0;

                if (is_dir($dir) === false)
                {
                    mkdir($dir);
                }

                //do a loop to handle each file individually
                foreach ($uploads as $upload)
                {
                    $i++;

                    if ($upload->getName() != '')
                    {
                        $check = getimagesize($upload->getTempName());
                        $min_width = 300;
                        $min_height = 500;
                        $width = $check[0];
                        $height = $check[1];
                        $image_temp = $upload->getTempName();
                        $image_type = $upload->getType();

                        switch(strtolower($image_type))
                        {
                            //Create new image from file
                            case 'image/png':
                                $image_resource =  imagecreatefrompng($image_temp);
                                break;
                            case 'image/gif':
                                $image_resource =  imagecreatefromgif($image_temp);
                                break;
                            case 'image/jpeg': case 'image/pjpeg':
                                $image_resource = imagecreatefromjpeg($image_temp);
                                break;
                            default:
                                $image_resource = false;
                        }

                        if ($check !== false)
                        {
                            if ($width < $height)
                            {
                                if ((($width >= $min_width) && ($height >= $min_height)))
                                {
                                    //$image_scale        = min($max_width / $width, $max_height / $height);
                                    //$new_image_width    = ceil($image_scale * $width);
                                    //$new_image_height   = ceil($image_scale * $height);
                                    $new_canvas         = imagecreatetruecolor($width , $height);

                                    $name = uniqid('_') . '_' . $ads->id . '.' . strtolower($upload->getExtension());
                                    $path = $dir . '/' . strtolower($name);

                                    if (imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $width, $height, $width, $height))
                                    {
                                        //center watermark
                                        $watermark_left = ($width/2)-(300/2); //watermark left
                                        $watermark_bottom = ($height/2)-(100/2); //watermark bottom

                                        $watermark = imagecreatefrompng($watermark_path.'watermark.png'); //watermark image
                                        imagecopy($new_canvas, $watermark, $watermark_left, $watermark_bottom, 0, 0, 300, 100); //merge image

                                        //output image direcly on the browser.
                                        header('Content-Type: image/jpeg');
                                        //imagejpeg($new_canvas, NULL , 90);

                                        //Or Save image to the folder
                                        imagejpeg($new_canvas, $path , 90);

                                        //free up memory
                                        imagedestroy($new_canvas);
                                        imagedestroy($image_resource);
                                    }

                                    $photos = new Gallery();
                                    $photos->users_id = $user->id;
                                    $photos->ad_id = $ads->id;
                                    $photos->path = $name;
                                    $photos->main = 'N';

                                    if (!$photos->save())
                                    {
                                        foreach ($photos->getMessages() as $message)
                                        {
                                            $this->flash->error($message);
                                        }
                                    }

                                    //$this->flash->success('Upload successful!' . $check['mime'] . ' - ' . $check[0] . 'x' . $check[1]);
                                    $this->response->redirect('private/gallery/' . $idarray[0] . '-' . $idarray[1]);
                                }
                                else
                                {
                                    $this->flash->error('Upload photo ' . $i . ' - photo must be larger or equal then 500x300 px!');
                                }
                            }
                            else
                            {
                                //need to allow also landscape photos
                                $this->flash->error('Upload photo ' . $i . ' - only portrait photos that are larger or equal then 500x300 px are allowed for upload!');
                            }
                        }
                        else
                        {
                            $this->flash->error('File is not an image ' . $check['mime'] . '!');
                        }
                    }
                }
                //if any file couldn’t be moved, then throw an message
                //($isUploaded) ? die('Files successfully uploaded.') : die('Some error ocurred.');
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function addprofileAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $form = new AdForm();

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $dt = new \DateTime();
                    $datetime = $dt->format('Y-m-d H:i:s');
                    $ad = new Ad();
                    $ad->users_id = $user->id;
                    $ad->showname = $this->request->getPost('showname');
                    $ad->slogan = $this->request->getPost('slogan');
                    $ad->gender = $this->request->getPost('gender');
                    $ad->age = $this->request->getPost('age');
                    $ad->ethnicity = $this->request->getPost('ethnicity');
                    $ad->nationality = $this->request->getPost('nationality');
                    $ad->home_country = $this->request->getPost('home_country');
                    $ad->hairstyle = $this->request->getPost('hairstyle');
                    $ad->eyes = $this->request->getPost('eyes');
                    $ad->measurement = $this->request->getPost('measurement');
                    $ad->languages = $this->request->getPost('languages');
                    $ad->working_time = $this->request->getPost('working_time');
                    $ad->about_me = $this->request->getPost('about_me');
                    $ad->working_country = $this->request->getPost('working_country');

                    $cities = $this->request->getPost('working_city_sel');
                    if (count($cities) == 1)
                    {
                        $ad->working_city1 = $cities[0];
                    }
                    elseif (count($cities) == 2)
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = $cities[1];
                    }
                    elseif (count($cities) == 3)
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = $cities[1];
                        $ad->working_city3 = $cities[2];
                    }
                    else
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = $cities[1];
                        $ad->working_city3 = $cities[2];
                        $ad->working_city4 = $cities[3];
                    }

                    $ad->price1 = $this->request->getPost('price1');
                    $ad->price2 = $this->request->getPost('price2');
                    $ad->price3 = $this->request->getPost('price3');
                    $ad->price4 = $this->request->getPost('price4');
                    $ad->phone = $this->request->getPost('phone');
                    $ad->contact_me = $this->request->getPost('contact_me');
                    $ad->no_witheld = $this->request->getPost('no_witheld');
                    $ad->whatsapp = $this->request->getPost('chekWhatsapp');
                    $ad->viber = $this->request->getPost('chekViber');
                    $ad->line = $this->request->getPost('chekLine');
                    $ad->wechat = $this->request->getPost('chekWechat');
                    $ad->skype = $this->request->getPost('skype');
                    $ad->website = $this->request->getPost('website');
                    $ad->services = $this->request->getPost('services');
                    $ad->email = $this->request->getPost('email');
                    $ad->orientation = $this->request->getPost('orientation');
                    $ad->created = $datetime;

                    if ($ad->save())
                    {
                        $this->flash->success('New model profile added. Now you have to add at least one photo to activate your profile!');
                        $form->clear();

                        $this->session->set('bio', array(
                            'id' => $ad->id
                        ));

                        return $this->response->redirect('private/gallery/'.$ad->showname.'-'.$ad->id);
                    }
                    else
                    {
                        foreach ($ad->getMessages() as $message)
                        {
                            $this->flash->error($message);
                        }
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function managemodelsAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $sql = 'SELECT a.*, ad.packages_id, g.path, c.country_iso_code from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.advertisement = "Y" and a.end_date > now() and a.active = "Y" and a.deleted = "N"  group by a.id order by a.working_country ASC';
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads = $data->fetchAll();

            $sql1 = 'SELECT a.*, g.path, c.country_iso_code from ad a inner join gallery g on a.id = g.ad_id inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and (a.advertisement = "N" or (a.advertisement = "Y" and a.end_date < now())) and a.active = "Y" and a.deleted = "N" group by a.id order by a.working_country ASC';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $aads = $data1->fetchAll();

            $sql2 = 'SELECT a.*, g.path, c.country_iso_code from ad a inner join gallery g on a.id = g.ad_id inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.active = "N" and a.deleted = "N" and (a.advertisement = "N" or end_date < now()) group by a.id order by a.working_country ASC';
            $conn2 = $this->db;
            $data2 = $conn2->query($sql2);
            $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $iads = $data2->fetchAll();

            $sql3 = 'SELECT a.*, c.country_iso_code from ad a inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.active = "N" and a.deleted = "N" and a.photos = "N" and (a.advertisement = "N" or end_date < now()) group by a.id order by a.working_country ASC';
            $conn3 = $this->db;
            $data3 = $conn3->query($sql3);
            $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $iadsn = $data3->fetchAll();

            $this->view->ads = $ads;
            $this->view->aads = $aads;
            $this->view->iads = $iads;
            $this->view->iadsn = $iadsn;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function editprofileAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            $ads = Ad::findFirstById($idarray[1]);
            $this->view->ads = $ads;

            $form = new AdForm($ads, array());

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $ad = Ad::findFirstById($this->request->getPost('ad_id'));
                    $ad->showname = $this->request->getPost('showname');
                    $ad->slogan = $this->request->getPost('slogan');
                    $ad->gender = $this->request->getPost('gender');
                    $ad->age = $this->request->getPost('age');
                    $ad->ethnicity = $this->request->getPost('ethnicity');
                    $ad->nationality = $this->request->getPost('nationality');
                    $ad->home_country = $this->request->getPost('home_country');
                    $ad->hairstyle = $this->request->getPost('hairstyle');
                    $ad->eyes = $this->request->getPost('eyes');
                    $ad->measurement = $this->request->getPost('measurement');
                    $ad->languages = $this->request->getPost('languages');
                    $ad->working_time = $this->request->getPost('working_time');
                    $ad->about_me = $this->request->getPost('about_me');
                    $ad->working_country = $this->request->getPost('working_country');

                    $cities = $this->request->getPost('working_city_sel');
                    if (count($cities) == 1)
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = null;
                        $ad->working_city3 = null;
                        $ad->working_city4 = null;
                    }
                    elseif (count($cities) == 2)
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = $cities[1];
                        $ad->working_city3 = null;
                        $ad->working_city4 = null;
                    }
                    elseif (count($cities) == 3)
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = $cities[1];
                        $ad->working_city3 = $cities[2];
                        $ad->working_city4 = null;
                    }
                    else
                    {
                        $ad->working_city1 = $cities[0];
                        $ad->working_city2 = $cities[1];
                        $ad->working_city3 = $cities[2];
                        $ad->working_city4 = $cities[3];
                    }

                    $ad->price1 = $this->request->getPost('price1');
                    $ad->price2 = $this->request->getPost('price2');
                    $ad->price3 = $this->request->getPost('price3');
                    $ad->price4 = $this->request->getPost('price4');
                    $ad->phone = $this->request->getPost('phone');
                    $ad->contact_me = $this->request->getPost('contact_me');
                    $ad->no_witheld = $this->request->getPost('no_witheld');
                    $ad->whatsapp = $this->request->getPost('chekWhatsapp');
                    $ad->viber = $this->request->getPost('chekViber');
                    $ad->line = $this->request->getPost('chekLine');
                    $ad->wechat = $this->request->getPost('chekWechat');
                    $ad->skype = $this->request->getPost('skype');
                    $ad->website = $this->request->getPost('website');
                    $ad->services = $this->request->getPost('services');
                    $ad->orientation = $this->request->getPost('orientation');

                    if ($ad->update())
                    {
                        $this->flash->success('You have successfully updated profile of your model '.$ad->showname.'!');
                        $form->clear();

                        $this->session->set('bio', array(
                            'id' => $ad->id
                        ));

                        return $this->response->redirect('private/managemodels');
                    }
                    else
                    {
                        foreach ($ad->getMessages() as $message)
                        {
                            $this->flash->error($message);
                        }
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function vipAction()
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $form = new VipForm();

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $package_id = 8;
                    $ad_id = $this->request->getPost('adverts');

                    $myPack = Packages::findFirst(array(
                        'id = ' . $package_id
                    ));

                    $price = $myPack->price;

                    $param = $ad_id . "-" . $package_id . "-" . $price;

                    $this->response->redirect('private/pay/' . $param);
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function paymentAction()
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $form = new PaymentForm();

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $ad_id = $this->request->getPost('adverts');
                    $package_id = $this->request->getPost('packages');

                    $package = Packages::findFirst(array(
                        'id =' . $package_id
                    ));

                    $price = $package->price;

                    if ($package_id != 7)
                    {
                        $param = $ad_id . "-" . $package_id . "-" . $price;

                        $this->response->redirect('private/pay/' . $param);
                    }
                    else
                    {
                        /*$sql = 'SELECT COUNT(*) as allFree FROM advertising WHERE users_id = '.$user->id.' AND packages_id = 7 AND end_date > NOW()';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $checkAdv = $data->fetchAll();

                        if ($checkAdv[0]['allFree'] < 1) {*/
                            $days = $package->day;
                            $d = new \DateTime();
                            $d1 = $d->format("Y-m-d H:i:s");
                            $endDate = date("Y-m-d H:i:s", (time() + (86400 * $days)));
                            $param = 7;

                            $advertising = new Advertising();
                            $advertising->users_id = $user->id;
                            $advertising->ad_id = $ad_id;
                            $advertising->packages_id = $package_id;
                            $advertising->date = $d1;
                            $advertising->end_date = $endDate;
                            $advertising->days = $days;
                            $advertising->save();

                            $this->response->redirect('private/result/' . $param);
                        /*}
                        else {
                            $this->flash->error('You can have only one active FREE package at one time! Please select different package.');
                        }*/
                    }
                }
            }
            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function extendAction($param)
    {
        try {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $form = new ExtendForm();

            $ad = Ad::findFirst(array(
                'id =' . $param
            ));

            $currModel = $ad->showname . ' - ' . $ad->id . ' ' . $ad->working_country . ' -> Package ends: ' . $ad->end_date . ' CET';

            $this->view->currModel = $currModel;
            $this->view->ad_id = $param;

            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $ad_id = $this->request->getPost('adverts');
                    $package_id = $this->request->getPost('packages');

                    $package = Packages::findFirst(array(
                        'id =' . $package_id
                    ));

                    $price = $package->price;

                    if ($package_id != 7) {
                        $param = $ad_id . "-" . $package_id . "-" . $price;

                        $this->response->redirect('private/pay/' . $param);
                    } else {
                        /*$sql = 'SELECT COUNT(*) as allFree, ad_id as adId FROM advertising WHERE users_id = ' . $user->id . ' AND packages_id = 7 AND end_date > NOW()';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $checkAdv = $data->fetchAll();

                        if ($checkAdv[0]['allFree'] < 1 || $checkAdv[0]['adId'] == $ad_id) {*/
                            $days = $package->day;
                            $d = new \DateTime();
                            $d1 = $d->format("Y-m-d H:i:s");
                            $endDate = date("Y-m-d H:i:s", (time() + (86400 * $days)));
                            $param = 7;

                            $advertising = new Advertising();
                            $advertising->users_id = $user->id;
                            $advertising->ad_id = $ad_id;
                            $advertising->packages_id = $package_id;
                            $advertising->date = $d1;
                            $advertising->end_date = $endDate;
                            $advertising->days = $days;
                            $advertising->save();

                            $this->response->redirect('private/result/' . $param);
                        /*} else {
                            $this->flash->error('You can have only one active FREE package at one time! Please select different package.');
                        }*/
                    }
                }
            }
            $this->view->form = $form;
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function payAction($param)
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $aParam = explode('-', $param);
            $price = 0.01; //$aParam[2];
            $micro = sprintf("%06d",(microtime(true) - floor(microtime(true))) * 1000000);

            $json = '{"version":"3","public_key":"'.$this->config->application->liqpay_public.'","action":"pay","amount":'.$price.',"currency":"EUR","description":"Diamond","order_id":"'.$user->id.'|'.$aParam[0].'|'.$aParam[1].'|'.$price.'|'.$micro.'","language":"en","sandbox":"1","server_url":"http://'.$_SERVER['SERVER_NAME'].'/callback","result_url":"http://'.$_SERVER['SERVER_NAME'].'/private/result"}';
            // after language "sandbox":"1" for sandbox payments

            $data = base64_encode($json);
            $signature = base64_encode(sha1($this->config->application->liqpay_private.$data.$this->config->application->liqpay_private, 1));

            $this->view->price = $aParam[2];
            $this->view->data = $data;
            $this->view->signature = $signature;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function resultAction($param)
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();

            if ($param == 7)
            {
                $status = 'free';
                $price = 0;
            }
            else
            {
                $payments = Payments::find(array(
                    'users_id = ' . $user->id, 'order' => 'id DESC', 'limit' => 1
                ));

                $package = Packages::findFirst(array(
                    'id =' . $payments[0]->packages_id
                ));

                $status = $payments[0]->status;
                $price = $package->price;
            }

            $this->view->price = $price;
            $this->view->status = $status;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function changepackageAction($param)
    {
        try
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();

            $sql = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.users_id = '.$user->id.' and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.id = '.$param.' group by a.id';
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads = $data->fetchAll();

            $this->view->ads = $ads;

            $form = new ChangeModelForm();

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $old_ad_id = $param;
                    $new_ad_id = $this->request->getPost('adverts');

                    $ad = Ad::findFirst(array(
                        'id = ' . $old_ad_id
                    ));

                    $vip = $ad->vip;
                    $ad_date = $ad->ad_date;
                    $end_date = $ad->end_date;
                    $end_vip = $ad->end_vip;
                    $days = $ad->ad_days;
                    $vip_days = $ad->vip_days;

                    $ad->advertisement = 'N';
                    $ad->ad_date = null;
                    $ad->end_date = null;
                    $ad->ad_days = 0;
                    if ($vip === 'Y')
                    {
                        $ad->vip = 'N';
                        $ad->end_vip = '0000-00-00 00:00:00';
                        $ad->vip_days = 0;
                    }
                    $ad->update();

                    $adv = Advertising::findFirst(array(
                        'ad_id = ' . $old_ad_id . ' and date = "' .$ad_date .'"'
                    ));
                    $package_id = $adv->packages_id;
                    $adv->delete();

                    if ($vip === 'Y')
                    {
                        $advv = Advertising::findFirst(array(
                            'ad_id = ' . $old_ad_id . ' and end_date = "' .$end_vip .'"'
                        ));
                        $package_id_vip = $advv->packages_id;
                        $advv->delete();
                    }

                    $advert = new Advertising();
                    $advert->users_id = $user->id;
                    $advert->ad_id = $new_ad_id;
                    $advert->packages_id = $package_id;
                    $advert->date = $ad_date;
                    $advert->end_date = $end_date;
                    $advert->days = $days;
                    $advert->save();

                    if ($vip === 'Y')
                    {
                        $advertv = new Advertising();
                        $advertv->users_id = $user->id;
                        $advertv->ad_id = $new_ad_id;
                        $advertv->packages_id = $package_id_vip;
                        $advertv->date = $ad_date;
                        $advertv->end_date = $end_vip;
                        $advertv->days = $vip_days;
                        $advertv->save();
                    }

                    $this->flash->success('Package changed successfully');
                    $this->response->redirect('private/managemodels');
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function toursAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();
            $idarray = explode('-', $param);

            $ads = Ad::findFirstById($idarray[1]);

            $form = new ToursForm($ads, array());

            $t = Mytours::findByAd_id($idarray[1]);
            $this->view->t = $t;
            $this->view->mname = $idarray[0];
            $this->view->mid = $idarray[1];

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $country = $this->request->getPost('working_country');
                    $cities = $this->request->getPost('working_city_sel1');
                    $city = $cities[0];
                    $startdate = $this->request->getPost('from');
                    $enddate = $this->request->getPost('to');
                    $fromHour = $this->request->getPost('fromH');
                    $toHour = $this->request->getPost('toH');
                    $ds = new \DateTime($startdate);
                    $ds->add(new \DateInterval("PT{$fromHour}H"));
                    $datetime1 = $ds->format('Y-m-d H:i:s');
                    $de = new \DateTime($enddate);
                    $de->add(new \DateInterval("PT{$toHour}H"));
                    $datetime2 = $de->format('Y-m-d H:i:s');

                    if ($datetime2 < $datetime1)
                    {
                        $this->flash->error('End date must be set so it is at least 1 day after start date!');
                    }
                    else
                    {
                        $tour = new Mytours();
                        $tour->users_id = $user->id;
                        $tour->ad_id = $idarray[1];
                        $tour->country = $country;
                        $tour->city = $city;
                        $tour->datestart = $datetime1;
                        $tour->dateend = $datetime2;
                        $tour->fromHour = strlen($fromHour) > 1 ? $fromHour.":00" : "0".$fromHour.":00";
                        $tour->toHour = strlen($toHour) > 1 ? $toHour.":00" : "0".$toHour.":00";;

                        if ($tour->save())
                        {
                            $this->flash->success('You have successfully set new tour.');
                            $this->response->redirect('private/tours/' . $idarray[0] . '-' . $idarray[1]);
                        }
                        else
                        {
                            $this->flash->error('Something went wrong and new tour could not be set!');
                            $form->clear();
                        }
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function deleteAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $idarray = explode('-', $param);

            if ($idarray[1] == 'tours')
            {
                $this->db->delete('mytours', 'id = ' . $idarray[0]);

                $this->flash->success('You have successfully deleted tour.');
                $this->response->redirect('private/tours/' . $idarray[2] . '-' . $idarray[3]);
            }
            elseif ($idarray[1] == 'support')
            {
                $this->db->delete('support', 'id = ' . $idarray[0]);

                $this->flash->success('You have successfully deleted support ticket.');
                $this->response->redirect('private/support');
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function verificationAction()
    {
        $this->persistent->conditions = null;
    }

    public function settingsAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $form = new UsersForm();

            $u = Users::findFirst(array(
                'id = ' . $user->id
            ));
            $this->view->u = $u;

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    $salt = $u->salt;
                    $pwd = $this->request->getPost('opassword');
                    $newpwd = $this->request->getPost('password');

                    if ($pwd == $salt && $pwd != $newpwd)
                    {
                        $user = Users::findFirstById($user->id);
                        $user->password = $this->security->hash($newpwd);
                        $user->salt = $newpwd;

                        if ($user->update())
                        {
                            $this->flash->success('You have successfully changed your password.');
                            $this->response->redirect('private');
                        }
                    }
                    elseif ($pwd == $newpwd)
                    {
                        $this->flash->error('Your new password must be different then old one!');
                        $form->clear();
                    }
                    else
                    {
                        $this->flash->error('Your old password is not the same as in database!');
                        $form->clear();
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function supportAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $numberPage = 1;
            $support = Support::findByUsers_id($user->id);
            $paginator = new Paginator(array(
                "data"  => $support,
                "limit" => 10,
                "page"  => $numberPage
            ));
            $this->view->page = $paginator->getPaginate();

            $form = new SupportForm();

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else
                {
                    if (!$user)
                    {
                        $this->flash->error('There is an error!');
                    }
                    else
                    {
                        $ts = new \DateTime();
                        $str = $ts->format('Y-m-d H:i:s');

                        $support = new Support();
                        $support->users_id = $user->id;
                        $support->subject = $this->request->getPost('subject');
                        $support->message = $this->request->getPost('message');
                        $support->path_to_file = '/';
                        $support->date = $str;

                        if ($support->save())
                        {
                            $this->flash->success('Thank you for sending a support ticket. We will reply to your support ticket ASAP!');
                            $form->clear();
                            return $this->response->redirect('private/support');
                        }
                        else
                        {
                            foreach ($support->getMessages() as $message)
                            {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function videoAction()
    {
        $this->persistent->conditions = null;
    }

    // to-do
    public function pmAction()
    {
        $this->persistent->conditions = null;

        $user = $this->auth->getUser();

        $numberPage = 1;

        //$pm = PrivateMessages::findByUsers_id($user->id);
        $sql = 'SELECT pm.*, u.name from private_messages pm inner join users u on pm.users_id = u.id inner join ad a on pm.to_user = a.id where a.users_id = "'.$user->id.'" group by a.users_id ASC';
        $conn = $this->db;
        $data = $conn->query($sql);
        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $results = $data->fetchAll();

        /*
          * SELECT pm.*, a.showname from private_messages pm inner join ad a on pm.to_user = a.id where pm.users_id = "'.$user->id.'"  group by pm.users_id ASC
         */

        $paginator = new Paginator(array(
            "data"  => $results,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $results;

        $form = new PMForm();

        if ($this->request->isPost())
        {
            if ($form->isValid($this->request->getPost()) == false)
            {
                foreach ($form->getMessages() as $message)
                {
                    $this->flash->error($message);
                }
            }
            else
            {
                if (!$user)
                {
                    $this->flash->error('There is an error!');
                }
                else
                {
                    $ts = new \DateTime();
                    $str = $ts->format('Y-m-d H:i:s');

                    $privatem = new PrivateMessages();
                    $privatem->users_id = $user->id;
                    $privatem->to_user = $this->request->getPost('ad');
                    $privatem->message = $this->request->getPost('message');
                    $privatem->date = $str;

                    if ($privatem->save())
                    {
                        $this->flash->success('You send a private message!');
                        $form->clear();
                        return $this->response->redirect('member/support');
                    }
                    else
                    {
                        foreach ($privatem->getMessages() as $message)
                        {
                            $this->flash->error($message);
                        }
                    }
                }
            }
        }

        $this->view->form = $form;
    }

    // to-do
    public function commentsAction()
    {
        $this->persistent->conditions = null;
    }

    public function boostprofileAction()
    {
        $this->persistent->conditions = null;
    }

    public function blacklistAction()
    {
        $this->persistent->conditions = null;
    }

    public function changecityAction()
    {
        try
        {
            $this->view->disable();

            if($this->request->isPost() == true)
            {
                if ($this->request->isAjax() == true)
                {
                    try
                    {
                        $val = $this->request->getJsonRawBody();
                        $country = Country::findFirst(array(
                            'country_name = "'.$val.'"'
                        ));
                        $country_iso_code = $country->country_iso_code;
                        $data = City::find(array(
                            'country_iso_code = "'.$country_iso_code.'" and city_name<>""', 'group' => 'city_name', 'order' => 'city_name ASC'
                        ));

                        foreach ($data as $result)
                        {
                            $resData[] = ['name' => $result->city_name];
                        }

                        echo $this->jsonEncode($resData);
                    }
                    catch (AuthException $e)
                    {
                        $this->flash->error($e->getMessage());
                    }
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * @param $arr
     * @return string
     */
    private function jsonEncode($arr)
    {
        try
        {
            $str = '{';
            $count = count($arr);
            $current = 0;

            foreach ($arr as $key => $value)
            {
                $str .= sprintf('"%s":', $this->sanitizeForJSON($key));

                if (is_array($value))
                {
                    $str .= '[';
                    foreach ($value as &$val)
                    {
                        $val = $this->sanitizeForJSON($val);
                    }
                    $str .= '"' . implode('","', $value) . '"';
                    $str .= ']';
                }
                else
                {
                    $str .= sprintf('"%s"', $this->sanitizeForJSON($value));
                }

                $current ++;
                if ($current < $count)
                {
                    $str .= ',';
                }
            }

            $str.= '}';

            return $str;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * @param string $str
     * @return string
     */
    private function sanitizeForJSON($str)
    {
        try
        {
            // Strip all slashes:
            $str = stripslashes($str);

            // Only escape backslashes:
            $str = str_replace('"', '\"', $str);

            return $str;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }
}