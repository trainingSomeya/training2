<?php
App::uses('AppController', 'Controller');
class ViewController extends AppController {
	public $components = array('Paginator');

	public function image($id = null) {
                /*$fileid       = $this->Image->id;
                $file = $this->Image->filename;
                $image = "{ROOT}image/files/{model}/{field}/" .$fileid. $file;

                if (!file_exists($image)) {
                        throw new NotFoundException();
                }
                return new CakeResponse(array('type' => 'image/png', 'body' => readfile($image)));*/
              if (!$this->Post->exists($id)) {
                        throw new NotFoundException(__('Invalid post'));
                }
                $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));

                $post = $this->Post->find('first', $options);
                $this->autoRender = false;

                $mime_type = "image/png";
                $file_path = "image/files/image/filename/".$post['Image'][0]['id'].'/'.$post['Image'][0]['filename'];

                Header("Content-Type: $mime_type");
                readfile($file_path);
                //$this->response->type($mime_type);
                //$this->response->file($file_path);
        }

}
