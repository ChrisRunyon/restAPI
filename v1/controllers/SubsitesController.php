<?php

require_once(__DIR__ . '/ApiController.php');

class SubsitesController extends ApiController {
    public $connection;
    private $model;
    private $action;

    /**
    * Attaches Model with identical prefix
    * @param {Class} $model
    **/
    public function attachModel($model) {
        $this->model = $model;
    }

    /* /Users */
    /* Sample api calls:
        http://rest.localhost.tv/subsites/musics --> return json array for this subsite
        http://rest.localhost.tv/subsites/musics/ads/leaderboard  --> return leaderboard ad tag
        http://rest.localhost.tv/subsites/musics/ads/all --> return all four ad tags
    */
    /**
    * REST GET Action
    * @param {String} $request /subsites/{action}/
    * @return {Object} login JSON response data
    **/
    public function getAction($request) {

        /* subsites/musics */
        if(isset($request->url_elements[2])) {

            $subsite = $request->url_elements[2];

            /* /subsites/ads/leaderboard */
            if(isset($request->url_elements[3])) {

                $action = $request->url_elements[3];

                switch($action) {
                    case 'ads':
                        if(isset($request->url_elements[4])) {
                            $tag = $request->url_elements[4];
                            $connection = $this->getConnection();
                            $results = $connection->query($this->model->getTag($subsite, $tag));
                            $data = $results[0][$tag];
                            $connection->close();
                        } else {
                            $tag = 'all';
                            $connection = $this->getConnection();
                            $results = $connection->query($this->model->getTag($subsite, 0));
                            foreach($results as $key => $value) {
                                $data['ad_tags'][$key] = $value;
                            }
                            $connection->close();
                        }
                        break;
                    default:
                        // do nothing, this is not a supported action
                        $data['message'] = "action not supported";
                        break;
                }
            } else {

                $connection = $this->getConnection();
                $results = $connection->query($this->model->getModel($subsite));
                $ad_tags = $connection->query($this->model->getAds($subsite));
                $keys = array_keys($results);
                $last = count($results[$keys[0]]);

                for($i = 0; $i < $last; $i++) {
                    foreach ($results as $key => $value) {
                        $data['result'][$key] = $value;
                    }
                }
                foreach($ad_tags as $key => $value) {
                    $data['ad_tags'][$key] = $value;
                }
                $connection->close();
            }
        } else {
            $data['message'] = "Please specify a subsite.";
        }
        return $data;
    }

    /**
    * REST POST Action
    * @param {String} $request /account/{id}/{action}
    * @return {Object} login JSON response data
    **/
    public function postAction($request) {

        /* subsites/musics */
        if(isset($request->url_elements[2])) {

            /* Sample call: http://localhost/substies/musics/ads/edit */
            if(isset($request->url_elements[3]) && $request->url_elements[3] != 'create' && $request->url_elements != 'upload') {

                $subsite = $request->url_elements[2];
                $branch = $request->url_elements[3];
                $action = $request->url_elements[4];

                switch($branch) {
                    case 'ads':
                        switch($action) {
                            case 'create':
                                $connection = $this->getConnection();
                                $results = $connection->query($this->model->createAd($subsite));
                                break;
                            case 'edit':
                                $connection = $this->getConnection();
                                $results = $connection->query($this->model->editAd($subsite));
                                break;
                        }
                        break;
                    default:
                        break;
                }
            }
            /* Sample call: http://rest.localhost.tv/substies/musics/create  */
            else {

                $subsite = $request->url_elements[2];
                $action = $request->url_elements[3];

                switch($action) {
                    case 'create':
                        $connection = $this->getConnection();
                        $results = $connection->query($this->model->postModel($subsite));
                    break;
                }
            }
        }
        $data = $request->parameters;
        $data['message'] = "This data was submitted";
        return $data;
    }
}

