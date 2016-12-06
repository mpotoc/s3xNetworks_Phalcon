<?php
namespace Adverts\Controllers;

use Adverts\Forms\AdForm;
use Adverts\Forms\ChangeModelForm;
use Adverts\Forms\CoinsForm;
use Adverts\Forms\GalleryForm;
use Adverts\Forms\PaymentForm;
use Adverts\Forms\PMForm;
use Adverts\Forms\SupportForm;
use Adverts\Forms\ToursForm;
use Adverts\Forms\UsersForm;
use Adverts\Forms\VipForm;
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

            $coins = Coins::find(array(
                'users_id = ' . $user->id
            ));
            $sum_coins = 0;

            foreach ($coins as $c)
            {
                $sum_coins += $c->value;
            }

            $this->view->coins = $sum_coins;
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
            $sum = 0;
            $cSum = 0;

            $user = $this->auth->getUser();

            $sql = 'SELECT p.json FROM users u left join payments p on u.id = p.users_id WHERE u.parent_id = ' . $user->id;
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads = $data->fetchAll();

            $sql1 = 'SELECT u.name, u.email FROM users u WHERE u.parent_id = ' . $user->id;
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads1 = $data1->fetchAll();

            for ($i = 0; $i < count($ads); $i++)
            {
                $json[] = json_decode($ads[$i]['json'], true);
            }

            foreach ($json as $s)
            {
                $sum += $s['amount'];
            }
            $sum = $sum * 0.5;

            foreach ($json as $a)
            {
                $amount[] = $a['amount'];
            }

            foreach ($json as $d)
            {
                $desc[] = explode(' ', $d['description']);
            }

            for ($j = 0; $j < count($json); $j++)
            {
                $aDesc = $desc[$j];
                $coinSum = (int)$aDesc[0] - $amount[$j];
                $cSum += $coinSum;
            }
            $cSum = $cSum * 0.5;

            $this->view->cSum = $cSum;
            $this->view->sum = $sum;
            $this->view->userId = $user->id;
            $this->view->members= $ads1;
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
                        $min_width = 400;
                        $min_height = 600;
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
                                    $this->flash->error('Upload photo ' . $i . ' - photo must be larger or equal then 600x400 px!');
                                }
                            }
                            else
                            {
                                $this->flash->error('Upload photo ' . $i . ' - only portrait photos that are larger or equal then 600x400 px are allowed for upload!');
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

            $sql = 'SELECT a.*, ad.packages_id, g.path, c.country_iso_code from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N"  group by a.id order by a.working_country ASC';
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads = $data->fetchAll();

            $sql1 = 'SELECT a.*, g.path, c.country_iso_code from ad a inner join gallery g on a.id = g.ad_id inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.advertisement = "N" and a.active = "Y" and a.deleted = "N" group by a.id order by a.working_country ASC';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $aads = $data1->fetchAll();

            $sql2 = 'SELECT a.*, g.path, c.country_iso_code from ad a inner join gallery g on a.id = g.ad_id inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.advertisement = "N" and a.active = "N" and a.deleted = "N" group by a.id order by a.working_country ASC';
            $conn2 = $this->db;
            $data2 = $conn2->query($sql2);
            $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $iads = $data2->fetchAll();

            $sql3 = 'SELECT a.*, c.country_iso_code from ad a inner join country c on a.working_country = c.country_name where a.users_id = ' . $user->id . ' and a.advertisement = "N" and a.active = "N" and a.deleted = "N" and a.photos = "N" group by a.id order by a.working_country ASC';
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

    public function paymentOldAction() {
        try {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $coins = Coins::find(array(
                'users_id = ' . $user->id
            ));
            $sum_coins = 0;

            foreach ($coins as $c) {
                $sum_coins += $c->value;
            }

            $this->view->coins = $sum_coins;

            $form = new PaymentForm();

            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
                else {
                    $days = 0;
                    $price = 0;
                    $packageId = $this->request->getPost('payment');
                    $ad_id = $this->request->getPost('adverts');

                    $myPack = Packages::findFirst(array(
                        'id = ' . $packageId
                    ));

                    if ($packageId == 1) {
                        $days = $this->request->getPost('packagesd');
                        $price = $this->request->getPost('priced');
                    }
                    elseif ($packageId == 4) {
                        $days = $this->request->getPost('packagesg');
                        $price = $this->request->getPost('priceg');
                    }
                    elseif ($packageId == 7) {
                        $days = $this->request->getPost('packagess');
                        $price = $this->request->getPost('prices');
                    }
                    elseif ($packageId == 21) {
                        $days = $this->request->getPost('packagesf');
                        $price = $this->request->getPost('pricef');
                    }

                    $add_coins = $price*($myPack->coins/100);
                    $new_value = ($price*(-1))+$add_coins;
                    $total = $price-$add_coins;

                    if ($sum_coins >= $total) {
                        $d = new \DateTime();
                        $d1 = $d->format("Y-m-d H:i:s");
                        $endDate = date("Y-m-d H:i:s", (time()+(86400*$days)));

                        $advertising = new Advertising();
                        $advertising->users_id = $user->id;
                        $advertising->ad_id = $ad_id;
                        $advertising->packages_id = $packageId;
                        $advertising->date = $d1;
                        $advertising->end_date = $endDate;
                        $advertising->days = $days;

                        if ($advertising->save()) {
                            $coins = new Coins();
                            $coins->users_id = $user->id;
                            $coins->value = $new_value;
                            $coins->save();

                            $this->flash->success('You have successfully bought package '.$advertising->packages->name.' for your model '.$advertising->ad->showname.' with s3xcoins.');
                            return $this->response->redirect('private');
                        }
                        else {
                            foreach ($advertising->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                    else {
                        $this->flash->error('You do not have enough s3xcoins to pay advertising for this model. Buy more s3xcoins!');
                    }
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function vipAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $coins = Coins::find(array(
                'users_id = ' . $user->id
            ));
            $sum_coins = 0;

            foreach ($coins as $c)
            {
                $sum_coins += $c->value;
            }

            $this->view->coins = $sum_coins;

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
                    $days = $this->request->getPost('vipDays');
                    $packageId = 10;
                    $ad_id = $this->request->getPost('adverts');

                    $myPack = Packages::findFirst(array(
                        'id = ' . $packageId
                    ));

                    $price = $myPack->price*$days;
                    $new_value = ($price*(-1));

                    if ($sum_coins >= $price)
                    {
                        $d = new \DateTime();
                        $d1 = $d->format("Y-m-d H:i:s");
                        $endDate = date("Y-m-d H:i:s", (time()+(86400*$days)));

                        $advertising = new Advertising();
                        $advertising->users_id = $user->id;
                        $advertising->ad_id = $ad_id;
                        $advertising->packages_id = $packageId;
                        $advertising->date = $d1;
                        $advertising->end_date = $endDate;
                        $advertising->days = $days;

                        if ($advertising->save())
                        {
                            $coins = new Coins();
                            $coins->users_id = $user->id;
                            $coins->value = $new_value;
                            $coins->save();

                            $this->flash->success('You have successfully bought package '.$advertising->packages->name.' for your model '.$advertising->ad->showname.' with s3xcoins.');
                            return $this->response->redirect('private');
                        }
                        else
                        {
                            foreach ($advertising->getMessages() as $message)
                            {
                                $this->flash->error($message);
                            }
                        }
                    }
                    else
                    {
                        $this->flash->error('You do not have enough s3xcoins to pay advertising for this model. Buy more s3xcoins!');
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

    public function paymentAction() //was before coinsAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $form = new PaymentForm(); //CoinsForm()

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
                    $this->response->redirect('private/pay/' . $ad_id);
                }
            }

            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function payAction($param)
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            /*$packages = Packages::findFirst(array(
                'id = ' . $param
            ));*/

            $price = 200;
            //$coins = $packages->coins;
            $micro = sprintf("%06d",(microtime(true) - floor(microtime(true))) * 1000000);

            $json = '{"version":"3","public_key":"'.$this->config->application->liqpay_public.'","action":"pay","amount":'.$price.',"currency":"EUR","description":"Diamond","order_id":"'.$user->id.'|'.$param.'|'.$price.'|'.$micro.'","language":"en","server_url":"http://'.$_SERVER['SERVER_NAME'].'/callback.php","result_url":"http://'.$_SERVER['SERVER_NAME'].'/private/result"}';
            // after language "sandbox":"1",

            $data = base64_encode($json);
            $signature = base64_encode(sha1($this->config->application->liqpay_private.$data.$this->config->application->liqpay_private, 1));

            $this->view->price = $price;
            //$this->view->coins = $coins;
            $this->view->data = $data;
            $this->view->signature = $signature;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function resultAction()
    {
        try
        {
            $this->persistent->conditions = null;

            $user = $this->auth->getUser();

            $payments = Payments::find(array(
                'users_id = ' . $user->id, 'order' => 'id DESC', 'limit' => 1
            ));

            $package = Packages::findFirst(array(
                'id =' . $payments[0]->packages_id
            ));

            $this->view->price = $package->price;
            $this->view->coins = $package->coins;
            $this->view->status = $payments[0]->status;
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
                    $ds = new \DateTime($startdate);
                    $datetime1 = $ds->format('Y-m-d H:i:s');
                    $de = new \DateTime($enddate);
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

                        $sql = 'SELECT m.users_id, m.parent_id, m.level, r.sum, u.name FROM mlm m inner join revenue r on m.users_id = r.users_id inner join users u on m.users_id = u.id where m.level in ('.$data3[0]['level'].','.$data3[0]['level'].'+1,'.$data3[0]['level'].'+2,'.$data3[0]['level'].'+3,'.$data3[0]['level'].'+4,'.$data3[0]['level'].'+5)';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $data1 = $data->fetchAll();
                        $resData = array();

                        foreach ($data1 as $result)
                        {
                            array_push($resData, array('memberId' => $result['users_id'], 'parentId' => $result['parent_id'], 'amount' => $result['sum'], 'name' => $result['name'], 'level' => $result['level']));
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