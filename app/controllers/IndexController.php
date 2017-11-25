<?php
namespace Adverts\Controllers;

use Adverts\Models\Ad;
use Adverts\Models\Country;
use Adverts\Models\Gallery;
use Adverts\Auth\Exception as AuthException;
use Adverts\Models\Mytours;
use Phalcon\Http\Request;
use Adverts\Models\Packages;
use Adverts\Models\Comments;
use Adverts\Models\Payments;
use Adverts\Models\Advertising;
use Adverts\Models\Mlm;
use Adverts\Models\Counter;
use Adverts\Models\Likes;
use Adverts\Models\Users;
use Adverts\Models\Revenue;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Logger\Adapter\File as Logger;
use Adverts\Forms\BannerExchangeForm;

//TO-DO
/*
 * clean up code, make it faster with smart options not so much if and with methods calls if possible for SQL
 * sort boost that it brings you on top and also GOTD when they will be available
 */

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $mainLogo = $this->config->application->mainLogo;
        $mainTitle = $this->config->application->mainTitle;
        $wcountry = $this->config->application->workingCountry;
        $icountry = $this->config->application->indexCountry;

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

        if (!$this->auth->getIdentity())
        {
            $this->view->mainLogo = $mainLogo;
            $this->view->mainTitle = $mainTitle;
            $this->view->wcountry = $wcountry;
            $this->view->icountry = $icountry;
            $this->view->sites = $sites;
            $this->view->setTemplateBefore('public');
        }
        else
        {
            $this->persistent->conditions = null;
            $user = $this->auth->getUser();
            $this->view->user = $user;
            $this->view->profileName = strtolower($user->profile->name);
            $this->view->mainLogo = $mainLogo;
            $this->view->mainTitle = $mainTitle;
            $this->view->wcountry = $wcountry;
            $this->view->icountry = $icountry;
            $this->view->sites = $sites;
            $this->view->setTemplateBefore('privat');
        }
    }

    private static function getCountry($baseCountry)
    {
        try
        {
            $wcountry = Country::findFirst(array(
                'country_iso_code = "' . $baseCountry . '"'
            ));
            $country = $wcountry->country_name;

            return $country;
        }
        catch (AuthException $e)
        {
            //$this->flash->error($e->getMessage());
        }
}

    private static function getCountryQuery($country, $field)
    {
        try
        {
            $country2 = array();

            if ($country === 'France')
            {
                array_push($country2, $country, 'Monaco');
            }
            elseif ($country === 'South Africa')
            {
                array_push($country2, $country, 'Egypt', 'Kenya', 'Cameroon', 'Nigeria', 'Ghana', 'Ivory Coast');
            }
            elseif ($country === 'Mexico')
            {
                array_push($country2, $country, 'Argentina', 'Bolivia', 'Chile', 'Colombia', 'Cuba', 'Dominican Republic', 'Ecuador', 'Venezuela');
            }
            elseif ($country === 'Hong Kong')
            {
                array_push($country2, $country, 'Singapore', 'China', 'Thailand', 'Japan', 'Republic of Korea', 'Malaysia', 'Indonesia',
                    'Philippines', 'Taiwan', 'India', 'Oman', 'Bahrain', 'Kuwait', 'Kazakhstan', 'Qatar', 'Lebanon', 'Saudi Arabia', 'Macao',
                    'Hashemite Kingdom of Jordan');
            }
            elseif ($country === 'Belgium')
            {
                array_push($country2, $country, 'Netherlands', 'Luxembourg');
            }
            elseif ($country === 'Russia')
            {
                array_push($country2, $country, 'Ukraine', 'Belarus', 'Republic of Moldova', 'Romania', 'Bulgaria', 'Estonia', 'Latvia',
                    'Republic of Lithuania', 'Poland', 'Czech Republic', 'Slovak Republic', 'Hungary', 'Slovenia', 'Serbia', 'Croatia', 'Cyprus',
                    'Bosnia and Herzegovina');
            }
            elseif ($country === 'Sweden')
            {
                array_push($country2, $country, 'Norway', 'Finland', 'Denmark', 'Iceland');
            }
            else
            {
                array_push($country2, $country);
            }

            $country_length = count($country2);
            $query = $field . ' in ("';
            for ($i = 0; $i < $country_length; $i++)
            {
                if ($country_length === 1)
                {
                    $query .= $country2[$i];
                }
                else
                {
                    if ($i !== $country_length-1)
                    {
                        $query .= $country2[$i].'","';
                    }
                    else
                    {
                        $query .= $country2[$i];
                    }
                }
            }
            $query .= '")';

            return $query;
        }
        catch (AuthException $e)
        {
            //$this->flash->error($e->getMessage());
        }
    }

    public function indexAction()
    {
        try
        {
            $baseCountry = $this->config->application->baseCountry;
            $country = IndexController::getCountry($baseCountry);
            $query = IndexController::getCountryQuery($country, 'working_country');

            $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
            $conn = $this->db;
            $data = $conn->query($sql);
            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $results = $data->fetchAll();

            $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads = $data1->fetchAll();

            $sql2 = 'SELECT COUNT(*) AS num FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now()';
            $conn2 = $this->db;
            $data2 = $conn2->query($sql2);
            $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $cnt = $data2->fetchAll();

            $cnt_ads = count($ads);
            for ($i = 0; $i < $cnt_ads; $i++)
            {
                $sql3 = 'select count(*) as cnt from comments where ad_id = '.$ads[$i]['id'];
                $conn3 = $this->db;
                $data3 = $conn3->query($sql3);
                $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_cnt = $data3->fetchAll();
                $ads[$i]['cnt'] = $ads_cnt[0]['cnt'];
            }

            for ($j = 0; $j < $cnt_ads; $j++)
            {
                $sql4 = 'select count(*) as lk from likes where ad_id = '.$ads[$j]['id'];
                $conn4 = $this->db;
                $data4 = $conn4->query($sql4);
                $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_like = $data4->fetchAll();
                $ads[$j]['like'] = $ads_like[0]['lk'];
            }

            $this->view->res = $results;
            $this->view->ads = $ads;
            $this->view->cnt = $cnt[0];
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function escortAction($param)
    {
        try {
            $idarray = explode('-', $param);
            $i = count($idarray);
            $id = array_slice($idarray, $i - 1);
            $ip = $_SERVER['REMOTE_ADDR'];

            if ($id[0]) {
                $sql = 'SELECT COUNT(*) as numb from counter where ad_id = ' . $id[0] . ' and ip = "' . $ip . '"';
                $conn = $this->db;
                $data = $conn->query($sql);
                $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $checkCount = $data->fetchAll();

                if ($checkCount[0]['numb'] == 0) {
                    $count = new Counter();
                    $count->ad_id = $id[0];
                    $count->count = 1;
                    $count->ip = $ip;
                    $count->save();
                }

                $sql1 = 'SELECT a.*, ad.packages_id from ad a inner join advertising ad on a.ad_date = ad.date where a.id = "' . $id[0] . '"';
                $conn1 = $this->db;
                $data1 = $conn1->query($sql1);
                $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads = $data1->fetchAll();

                $gal = Gallery::find(array(
                    'ad_id = ' . $id[0]
                ));

                $tours = Mytours::find(array(
                    'ad_id = ' . $id[0]
                ));

                $sql3 = "SELECT sum(c.count) as total FROM counter c WHERE ad_id = " . $id[0];
                $conn3 = $this->db;
                $data3 = $conn3->query($sql3);
                $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $counter = $data3->fetchAll();

                $sql2 = 'SELECT co.comment, u.name from comments co inner join users u on co.users_id = u.id where co.ad_id = "' . $id[0] . '"';
                $conn2 = $this->db;
                $data2 = $conn2->query($sql2);
                $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $comments = $data2->fetchAll();

                $sql4 = 'select count(*) as lk from likes where ad_id = '.$id[0];
                $conn4 = $this->db;
                $data4 = $conn4->query($sql4);
                $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_like = $data4->fetchAll();

                $this->view->ads = $ads[0];
                $this->view->gal = $gal;
                $this->view->ct = count($tours);
                $this->view->tours = $tours;
                $this->view->comments = $comments;
                $this->view->counter = $counter[0]['total'];
                $this->view->likes = $ads_like[0]['lk'];
            }
        }
        catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function likeAction($param)
    {
        try {
            $idarray = explode('-', $param);
            $id = $idarray[1];
            $name = $idarray[0];
            $ip = $_SERVER['REMOTE_ADDR'];

            if ($id) {
                $sql = 'SELECT COUNT(*) as numb from likes where ad_id = ' . $id . ' and ip = "' . $ip . '"';
                $conn = $this->db;
                $data = $conn->query($sql);
                $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $checkLikes = $data->fetchAll();

                if ($checkLikes[0]['numb'] == 0) {
                    $like = new Likes();
                    $like->ad_id = $id;
                    $like->like = 1;
                    $like->dislike = 0;
                    $like->ip = $ip;
                    $like->save();
                }
            }

            $this->response->redirect('escort/' . $name . '-' . $id);
        }
        catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function cityAction($param)
    {
        try {
            $baseCountry = $this->config->application->baseCountry;
            $country = IndexController::getCountry($baseCountry);
            $query = IndexController::getCountryQuery($country, 'working_country');
            $query2 = IndexController::getCountryQuery($country, 'country');

            $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.' . $query . ' and (a.working_city1 = "' . $param . '" or a.working_city2 = "' . $param . '" or a.working_city3 = "' . $param . '" or working_city4 = "' . $param . '") and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads1 = $data1->fetchAll();
            $adsRemove = array();

            $sql2 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id inner join mytours m on a.id = m.ad_id where m.' . $query2 . ' and city = "' . $param . '" and m.datestart < now() and m.dateend > now() and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
            $conn2 = $this->db;
            $data2 = $conn2->query($sql2);
            $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $ads2 = $data2->fetchAll();

            foreach ($ads2 as $ad) {
                array_push($adsRemove, array($ad['id']));
            }

            $ads = array_merge($ads1, $ads2);

            $cnt_ads = count($ads);
            for ($i = 0; $i < $cnt_ads; $i++) {
                $sql3 = 'select count(*) as cnt from comments where ad_id = ' . $ads[$i]['id'];
                $conn3 = $this->db;
                $data3 = $conn3->query($sql3);
                $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_cnt = $data3->fetchAll();
                $ads[$i]['cnt'] = $ads_cnt[0]['cnt'];
            }

            for ($j = 0; $j < $cnt_ads; $j++) {
                $sql4 = 'select count(*) as lk from likes where ad_id = ' . $ads[$j]['id'];
                $conn4 = $this->db;
                $data4 = $conn4->query($sql4);
                $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_like = $data4->fetchAll();
                $ads[$j]['like'] = $ads_like[0]['lk'];
            }

            $this->view->city = $param;
            $this->view->ads = $ads;
            $this->view->test = $adsRemove[0][0];
        }
        catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function searchAction($param)
    {
        try
        {
            if (!empty($param))
            {
                $baseCountry = $this->config->application->baseCountry;
                $country = IndexController::getCountry($baseCountry);
                $query = IndexController::getCountryQuery($country, 'working_country');

                $count_char = substr_count($param, '-');
                $g = '';
                $gg = '';
                $city = '';
                $view_var = 0;

                if ($count_char === 0)
                {
                    $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                    $conn = $this->db;
                    $data = $conn->query($sql);
                    $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $results = $data->fetchAll();

                    $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and a.showname LIKE "%' . $param . '%" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                    $conn1 = $this->db;
                    $data1 = $conn1->query($sql1);
                    $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads = $data1->fetchAll();
                }
                elseif ($count_char === 1)
                {
                    $idarray = explode('-', $param);
                    $name = $idarray[0];
                    $id2 = $idarray[1];

                    if ($id2 == 'girls')
                    {
                        $g = 'F';
                        $gg = 'girls';
                    }
                    elseif ($id2 == 'trans')
                    {
                        $g = 'T';
                        $gg = 'trans';
                    }
                    elseif ($id2 == 'boys')
                    {
                        $g = 'M';
                        $gg = 'boys';
                    }
                    elseif ($id2 == 'new')
                    {
                        $gg = 'new';
                    }
                    else
                    {
                        $city = $id2;
                    }

                    if ($city == '')
                    {
                        if ($g == '')
                        {
                            $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                            $conn = $this->db;
                            $data = $conn->query($sql);
                            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $results = $data->fetchAll();

                            $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and now() <= Date_Add(a.created, interval 3 DAY) and a.showname LIKE "%' . $name . '%" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                            $conn1 = $this->db;
                            $data1 = $conn1->query($sql1);
                            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $ads = $data1->fetchAll();
                        }
                        else
                        {
                            $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                            $conn = $this->db;
                            $data = $conn->query($sql);
                            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $results = $data->fetchAll();

                            $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and a.gender = "' . $g . '" and a.showname LIKE "%' . $name . '%" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                            $conn1 = $this->db;
                            $data1 = $conn1->query($sql1);
                            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $ads = $data1->fetchAll();
                        }
                    }
                    else
                    {
                        $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $results = $data->fetchAll();

                        $view_var = 1;

                        $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and (a.working_city1 = "' . $city . '" or a.working_city2 = "' . $city . '" or a.working_city3 = "' . $city . '" or working_city4 = "' . $city . '") and a.showname LIKE "%' . $name . '%" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                        $conn1 = $this->db;
                        $data1 = $conn1->query($sql1);
                        $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $ads = $data1->fetchAll();
                    }
                }
                else
                {
                    $idarray = explode('-', $param);
                    $name = $idarray[0];
                    $city = $idarray[1];
                    $gender = $idarray[2];

                    if ($gender == 'girls')
                    {
                        $g = 'F';
                        $gg = 'girls';
                    }
                    elseif ($gender == 'trans')
                    {
                        $g = 'T';
                        $gg = 'trans';
                    }
                    elseif ($gender == 'boys')
                    {
                        $g = 'M';
                        $gg = 'boys';
                    }
                    else
                    {
                        $gg = 'new';
                    }

                    if ($g == '')
                    {
                        $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $results = $data->fetchAll();

                        $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and now() <= Date_Add(a.created, interval 3 DAY) and (a.working_city1 = "' . $city . '" or a.working_city2 = "' . $city . '" or a.working_city3 = "' . $city . '" or working_city4 = "' . $city . '") and a.showname LIKE "%' . $name . '%" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                        $conn1 = $this->db;
                        $data1 = $conn1->query($sql1);
                        $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $ads = $data1->fetchAll();
                    }
                    else
                    {
                        $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                        $conn = $this->db;
                        $data = $conn->query($sql);
                        $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $results = $data->fetchAll();

                        $view_var = 2;

                        $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and a.gender = "' . $g . '" and (a.working_city1 = "' . $city . '" or a.working_city2 = "' . $city . '" or a.working_city3 = "' . $city . '" or working_city4 = "' . $city . '") and a.showname LIKE "%' . $name . '%" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                        $conn1 = $this->db;
                        $data1 = $conn1->query($sql1);
                        $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $ads = $data1->fetchAll();
                    }
                }

                $sql2 = 'SELECT COUNT(*) AS num FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now()';
                $conn2 = $this->db;
                $data2 = $conn2->query($sql2);
                $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $cnt = $data2->fetchAll();

                $cnt_ads = count($ads);
                for ($i = 0; $i < $cnt_ads; $i++)
                {
                    $sql3 = 'select count(*) as cnt from comments where ad_id = '.$ads[$i]['id'];
                    $conn3 = $this->db;
                    $data3 = $conn3->query($sql3);
                    $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads_cnt = $data3->fetchAll();
                    $ads[$i]['cnt'] = $ads_cnt[0]['cnt'];
                }

                for ($j = 0; $j < $cnt_ads; $j++)
                {
                    $sql4 = 'select count(*) as lk from likes where ad_id = '.$ads[$j]['id'];
                    $conn4 = $this->db;
                    $data4 = $conn4->query($sql4);
                    $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads_like = $data4->fetchAll();
                    $ads[$j]['like'] = $ads_like[0]['lk'];
                }

                $this->view->cnt = $cnt[0];
                $this->view->res = $results;
                $this->view->ads = $ads;
                $this->view->c_ads = count($ads);
                $this->view->c_res = count($results);
                $this->view->city = $city;
                $this->view->gg = $gg;
                $this->view->view_var = $view_var;
            }
            else
            {
                $this->response->redirect('index');
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function escortsAction($param)
    {
        try
        {
            $baseCountry = $this->config->application->baseCountry;
            $country = IndexController::getCountry($baseCountry);
            $query = IndexController::getCountryQuery($country, 'working_country');

            $city = '';
            $g = '';
            $gg = '';
            $view_var = 0;

            if ($param == 'girls')
            {
                $g = 'F';
                $gg = 'girls';
            }
            elseif ($param == 'trans')
            {
                $g = 'T';
                $gg = 'trans';
            }
            elseif ($param == 'boys')
            {
                $g = 'M';
                $gg = 'boys';
            }
            elseif ($param == 'new')
            {
                $gg = 'new';
            }
            else
            {
                $idarray = explode('-', $param);
                $i = count($idarray);
                $city = array_slice($idarray, $i-1);
                $gen = array_slice($idarray, 0);

                if ($gen[0] == 'girls')
                {
                    $g = 'F';
                    $gg = 'girls';
                }
                elseif ($gen[0] == 'trans')
                {
                    $g = 'T';
                    $gg = 'trans';
                }
                elseif ($gen[0] == 'boys')
                {
                    $g = 'M';
                    $gg = 'boys';
                }
                elseif ($gen[0] == 'new')
                {
                    $gg = 'new';
                }
            }

            if ($g == '')
            {
                $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and now() <= Date_Add(created, interval 3 DAY) and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                $conn = $this->db;
                $data = $conn->query($sql);
                $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $results = $data->fetchAll();
            }
            else
            {
                $sql = 'SELECT country, city, SUM( cnt ) AS num, c.country_iso_code as iso FROM (
	SELECT working_country as country, working_city1 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city1
	UNION ALL
	SELECT working_country as country, working_city2 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city2 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city2
	UNION ALL
	SELECT working_country as country, working_city3 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city3 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city3
    UNION ALL
    SELECT working_country as country, working_city4 AS city, COUNT(*) AS cnt FROM ad WHERE '.$query.' and working_city4 IS NOT NULL and advertisement = "Y" and active = "Y" and deleted = "N" and gender = "'.$g.'" and end_date > now() GROUP BY working_city4
) tmp inner join country c on c.country_name = country GROUP BY tmp.city';
                $conn = $this->db;
                $data = $conn->query($sql);
                $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $results = $data->fetchAll();
            }

            if ($city == '')
            {
                if ($g == '')
                {
                    $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and now() <= Date_Add(a.created, interval 3 DAY) and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                    $conn1 = $this->db;
                    $data1 = $conn1->query($sql1);
                    $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads = $data1->fetchAll();
                }
                else
                {
                    $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and a.gender = "' . $g . '" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                    $conn1 = $this->db;
                    $data1 = $conn1->query($sql1);
                    $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads = $data1->fetchAll();
                }
            }
            else
            {
                $view_var = 1;
                if ($g == '')
                {
                    $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and (a.working_city1 = "' . $city[0] . '" or a.working_city2 = "' . $city[0] . '" or a.working_city3 = "' . $city[0] . '" or working_city4 = "' . $city[0] . '") and now() <= Date_Add(a.created, interval 3 DAY) and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                    $conn1 = $this->db;
                    $data1 = $conn1->query($sql1);
                    $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads = $data1->fetchAll();
                }
                else
                {
                    $sql1 = 'SELECT a.*, ad.packages_id, g.path from ad a inner join advertising ad on a.ad_date = ad.date inner join gallery g on a.id = g.ad_id where a.'.$query.' and (a.working_city1 = "' . $city[0] . '" or a.working_city2 = "' . $city[0] . '" or a.working_city3 = "' . $city[0] . '" or working_city4 = "' . $city[0] . '")  and a.gender = "' . $g . '" and a.advertisement = "Y" and a.active = "Y" and a.deleted = "N" and a.end_date > now() group by a.id order by ad.packages_id ASC, (a.vip = "Y" and a.end_vip > now()) DESC, RAND()';
                    $conn1 = $this->db;
                    $data1 = $conn1->query($sql1);
                    $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $ads = $data1->fetchAll();
                }
            }

            $sql2 = 'SELECT COUNT(*) AS num FROM ad WHERE '.$query.' and advertisement = "Y" and active = "Y" and deleted = "N" and end_date > now()';
            $conn2 = $this->db;
            $data2 = $conn2->query($sql2);
            $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $cnt = $data2->fetchAll();

            $cnt_ads = count($ads);
            for ($i = 0; $i < $cnt_ads; $i++)
            {
                $sql3 = 'select count(*) as cnt from comments where ad_id = '.$ads[$i]['id'];
                $conn3 = $this->db;
                $data3 = $conn3->query($sql3);
                $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_cnt = $data3->fetchAll();
                $ads[$i]['cnt'] = $ads_cnt[0]['cnt'];
            }

            for ($j = 0; $j < $cnt_ads; $j++)
            {
                $sql4 = 'select count(*) as lk from likes where ad_id = '.$ads[$j]['id'];
                $conn4 = $this->db;
                $data4 = $conn4->query($sql4);
                $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                $ads_like = $data4->fetchAll();
                $ads[$j]['like'] = $ads_like[0]['lk'];
            }

            $this->view->cnt = $cnt[0];
            $this->view->res = $results;
            $this->view->gg = $gg;
            $this->view->city = $city[0];
            $this->view->ads = $ads;
            $this->view->c_res = count($results);
            $this->view->c_ads = count($ads);
            $this->view->view_var = $view_var;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function error404Action()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }

    public function bonusAction()
    {

    }

    public function bannerAction()
    {
        try
        {
            $form = new BannerExchangeForm();

            if ($this->request->isPost())
            {
                if ($form->isValid($this->request->getPost()) == false)
                {
                    foreach ($form->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
                else {
                    $email = $this->request->getPost('email');
                    $domain = $this->request->getPost('domain');
                    $banner = $this->request->getPost('banner');
                    $msg = $this->request->getPost('msg');

                    // Create the email and send the message
                    $to = 'webmaster@s3xnetworks.com';
                    $email_subject = "Banner exchange";
                    $email_body = "You have received a new message from your website banner exchange form.\n\n" . "Here are the details:\n\nEmail: $email\n\nDomain: $domain\n\nBanner:\n$banner\n\nMessage:\n$msg";
                    $headers = "From: webmaster@s3xnetworks.com\n";
                    $headers .= "Reply-To: $email";
                    mail($to, $email_subject, $email_body, $headers);

                    $this->flash->success('Banner exchange form was submited successfully.');
                    $form->clear();
                }
            }
            $this->view->form = $form;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function faqAction()
    {

    }

    public function callbackAction()
    {
        try
        {
            $sig = $_POST['signature'];
            $levels = ['1','2','4','8','16','32','64','128','256','512','1024','2048','4096','8192','16384','32768','65536'];
            $xml_decode = base64_decode($_POST['data']);

            $logger = new Logger($this->config->application->logsDir . "payments.log");
            $logger->log($xml_decode);
            $logger->close();

            $arr = json_decode($xml_decode);

            $myarr = explode('|', $arr->{'order_id'});
            $users_id = $myarr[0];
            $ad_id = $myarr[1];
            $package_id = $myarr[2];
            $c_date = date("Y-m-d H:i:s", ($arr->{'create_date'} / 1000));
            $e_date = date("Y-m-d H:i:s", ($arr->{'end_date'} / 1000));
            $price = 200; //$myarr[3];
            $status = $arr->{'status'};

            $payment = new Payments();
            $payment->users_id = $users_id;
            $payment->packages_id = $package_id;
            $payment->json = $xml_decode;
            $payment->payment_id = $arr->{'payment_id'};
            $payment->status = $status;
            $payment->paytype = $arr->{'paytype'};
            $payment->acq_id = $arr->{'acq_id'};
            $payment->order_id = $arr->{'order_id'};
            $payment->liqpay_order_id = $arr->{'liqpay_order_id'};
            $payment->ip = $arr->{'ip'};
            $payment->create_date = $c_date;
            $payment->end_date = $e_date;
            $payment->transaction_id = $arr->{'transaction_id'};
            $payment->save();

            if ($status === 'success' || $status === 'sandbox')
            {
                $package = Packages::findFirst(array(
                    'id =' . $package_id
                ));

                $days = $package->day;
                $d = new \DateTime();
                $d1 = $d->format("Y-m-d H:i:s");
                $endDate = date("Y-m-d H:i:s", (time()+(86400*$days)));

                $advertising = new Advertising();
                $advertising->users_id = $users_id;
                $advertising->ad_id = $ad_id;
                $advertising->packages_id = $package_id;
                $advertising->date = $d1;
                $advertising->end_date = $endDate;
                $advertising->days = $days;
                $advertising->save();

                $mlmExists = Mlm::findFirst(array(
                    'users_id =' . $users_id
                ));

                if ($mlmExists->id)
                {
                    $revenue = new Revenue();
                    $revenue->users_id = $users_id;
                    $revenue->sum = $price;
                    $revenue->pay_date = $d1;
                    $revenue->save();
                }
                else
                {
                    $revenue = new Revenue();
                    $revenue->users_id = $users_id;
                    $revenue->sum = $price;
                    $revenue->pay_date = $d1;
                    $revenue->save();

                    $sql2 = "SELECT sum(r.sum) as total FROM revenue r WHERE users_id = " . $users_id;
                    $conn = $this->db;
                    $data2 = $conn->query($sql2);
                    $data2->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                    $total = $data2->fetchAll();

                    if ($total[0]['total'] >= 200)
                    {
                        $sql5 = "SELECT parent_id as pID FROM users WHERE id = " . $users_id;
                        $data5 = $conn->query($sql5);
                        $data5->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                        $parentId = $data5->fetchAll();

                        $newMlm = new Mlm();
                        $newMlm->users_id = $users_id;

                        if ($parentId[0]['pID'] > 0)
                        {
                            $sql6 = "SELECT m.level as lvl FROM mlm m WHERE users_id = " . $parentId[0]['pID'];
                            $data6 = $conn->query($sql6);
                            $data6->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $lvl2 = $data6->fetchAll();

                            $newMlm->parent_id = $parentId[0]['pID'];
                            $newMlm->level = $lvl2[0]['lvl'] + 1;
                            $newMlm->isFull = 0;
                        }
                        else
                        {
                            //maybe get all users ids where isFull is 0 and then if full update all or
                            //get by level and compare with level array on top ???
                            $sql = "SELECT users_id as uID FROM mlm WHERE isFull = 0 order by id ASC limit 1";
                            $data = $conn->query($sql);
                            $data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $userId = $data->fetchAll();

                            /*$sql3 = "SELECT count(*) as countPpl FROM mlm WHERE users_id = " . $userId[0]['uID'] . " or parent_id = " . $userId[0]['uID'];
                            $data3 = $conn->query($sql3);
                            $data3->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                            $countPpl = $data3->fetchAll();

                            if ($countPpl[0]['countPpl'] < 3) { }*/

                            if ($userId[0])
                            {
                                $sql4 = "SELECT m.level as lvl FROM mlm m WHERE users_id = " . $userId[0]['uID'];
                                $data4 = $conn->query($sql4);
                                $data4->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
                                $lvl = $data4->fetchAll();

                                $newMlm->parent_id = $userId[0]['uID'];
                                $newMlm->level = $lvl[0]['lvl'] + 1;
                                $newMlm->isFull = 0;
                            }
                            else
                            {
                                $newMlm->parent_id = 0;
                                $newMlm->level = 1;
                                $newMlm->isFull = 1;
                            }
                        }
                        $newMlm->save();
                    }
                }


                //else write to revenue, check if already >= 200 in revenue
                //if so add users_id to mlm table and check if it has parent_id
                //then add it under this parent if it has empty spots available
                //or to first empty spot in the mlm


                /*if ($total[0]['total'] >= 200 && $count[0]['count'] == 0)
                {
                    $sql6 = "INSERT INTO mlm m (m.users_id, m.parent_id, m.level) VALUES (".$users_id.", ".$user[0]['parent_id'].", ".$level.")";
                    $conn->query($sql6);

                    // send mail to manually add to mlm for now
                }*/

                /*
                SELECT * FROM `mlm` GROUP BY level
                SELECT count(level) FROM `mlm` WHERE level = 1;
                SELECT count(level) FROM `mlm` WHERE level = 2;
                SELECT count(level) FROM `mlm` WHERE level = 3;
                SELECT count(level) FROM `mlm` WHERE level = 4;
                SELECT count(level) FROM `mlm` WHERE level = 5;
                */
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function termsAction()
    {

    }

    public function contactAction()
    {

    }

    public function commentAction()
    {
        try
        {
            $user = $this->auth->getUser();

            if ($this->request->isPost())
            {
                if (!$user)
                {
                    $this->flash->error('There is an error!');
                }
                else
                {
                    $ad_id = $this->request->getPost('ad_id');
                    $name = $this->request->getPost('name');
                    $comment = new Comments();
                    $comment->users_id = $user->id;
                    $comment->ad_id = $ad_id;
                    $comment->comment = $this->request->getPost('comment');

                    if ($comment->save())
                    {
                        $this->flash->success('Your comment to escort' . $name . ' was added successfully.');
                        return $this->response->redirect('escort/' . $name . '-' . $ad_id);
                    }
                    else
                    {
                        foreach ($comment->getMessages() as $message)
                        {
                            $this->flash->error($message);
                        }
                    }
                }
            }
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }

    public function sitesAction()
    {
        try
        {
            $sql1 = 'SELECT * FROM sites where active = "Y"';
            $conn1 = $this->db;
            $data1 = $conn1->query($sql1);
            $data1->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $sites1 = $data1->fetchAll();

            $this->view->oursites = $sites1;
        }
        catch (AuthException $e)
        {
            $this->flash->error($e->getMessage());
        }
    }
}