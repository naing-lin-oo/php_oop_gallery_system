<?php
    class Photo extends Db_object {
        protected static $db_table = "photos";
        protected static $db_table_fields = array('id', 'title', 'caption', 'alternate_text', 'description', 'filename', 'type', 'size', 'user_id');
        public $id;
        public $title;
        public $caption;
        public $alternate_text;
        public $description;
        public $filename;
        public $type;
        public $size;
        public $user_id;
 
        public $tmp_path;
        public $upload_directory = "images";
        public $image_placeholder = "http://placehold.it/70x70&text=image";

        public function image_path_and_placeholder() {
            return empty($this->filename) ? $this->image_placeholder : $this->upload_directory.DS.$this->filename;
        }

        // This is passing $_FILES['uploaded_file'] as an arugment
        public function upload_photo_edit() {
            if(!empty($this->errors)) {   
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
            }
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)) {
                unset($this->tmp_path);
                return true;
            }
        }



        public function picture_path() {
            return $this->upload_directory.DS.$this->filename; // images/$filename
        }

        public function save() {
            if($this->id) {
                $this->update();
            } else {
                if(!empty($this->errors)) {
                    return false;
                }
                if(empty($this->filename) || empty($this->tmp_path)){
                    $this->errors[] = "the file was not available";
                }
                $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
                if(file_exists($target_path)) {
                    $this->errors[] = "The file {$this->filename} already exists";
                    return false;
                }
                if(move_uploaded_file($this->tmp_path, $target_path)) {
                    if($this->create()) {
                        unset($this->tmp_path);
                        return true;
                    }
                }
                $this->create();
            }
        }

        public function delete_photo() {
            if($this->delete()) {
                $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
                return unlink($target_path)? true: false;
            } else {
                return false;
            }
        }

        public static function display_sidebar_data($photo_id) {
            $photo = Photo::find_by_id($photo_id);
            $output  = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}' ></a> ";
            $output .= "<p>{$photo->filename}</p>";
            $output .= "<p>{$photo->type}</p>";
            $output .= "<p>{$photo->size}</p>";
            echo $output;
        }
    }
?>