<?php
    class User{
        public $id;
        public $fname;

        function __construct($id, $fname) {
            $this->id = $id;
            $this->fname = $fname;
        }
        public function getUID() {
            return $this->id;
        }
    
        public function getName() {
            return $this->fname;
        }
    }
?>