<?php


use OAuth1\OAuthRequestVerifier;
use OAuth1\OAuthException2;

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Uploader.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/MultiFileUploader.php');



class UploaderModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user_verify;

    /**
     *
     */
    public function getModel() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    /**
     * @param $action
     * @return string
     * @throws Exception
     */
    public function postModel($action, $name_dir) {
        if (OAuthRequestVerifier::requestIsSigned()) {
            try {
                $req = new OAuthRequestVerifier();
                $this->user_verify = $req->verify();

                // If we have an user_id, then login as that user (for this request)
                if ($this->user_verify) {

                    $this->response = '{data: failed}';
                    switch($action) {
                        case 'single':
                            $this->entity = new Uploader();
                            $file = $_FILES['uploaded'];
                            $this->entity->uploadFile($file, $name_dir);
                            $this->response = $this->entity->getFileName();
                            break;
                        case 'multi':
                            $this->entity = new MultiFileUploader();
                            $this->entity->multiFileUpload($_FILES, $this->user_verify, $name_dir);
                            $this->response = $_FILES;
                        default:
                            break;
                    }
                }
            } catch (OAuthException2 $e) {
                // The request was signed, but failed verification
                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: OAuth realm="not verified"');
                header('Content-Type: text/plain; charset=utf8');

                exit();
            }
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: OAuth realm="not signed"');
            header('Content-Type: text/plain; charset=utf8');

           exit();
        }
        return $this->response;
    }
}
