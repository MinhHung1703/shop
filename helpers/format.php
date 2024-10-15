<?php
    /**
    * Format Class
    */
    class Format{
        //Định dạng ngày giờ
        public function formatDate($date){
            return date('F j, Y, g:i a', strtotime($date));
        }

        //Định dạng tiêu đề chuẩn hơn
        public function textShorten($text, $limit = 400){
            $text = $text. " ";
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text.".....";
            return $text;
        }

        //Validate dữ liệu form, cũng kiểm tra rỗng hay không
        public function validation($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Kiểm tra tên SERVER và định dạng cho nó (Như kiểu trang index có thể là home đấy)
        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            //$title = str_replace('_', ' ', $title);
            if ($title == 'index') {
            $title = 'home';
            }elseif ($title == 'contact') {
            $title = 'contact';
            }
            return $title = ucfirst($title);
        }
    }
?>
