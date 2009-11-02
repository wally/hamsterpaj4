<?php
    class PageEntertainRandom extends Page
    {
        public static function url_hook($uri)
        {
            global $_ENTERTAIN;
            
            $pieces = explode('/', $uri);
            $categories = array_keys($_ENTERTAIN['categories']);
            
            if ( in_array($pieces[1], $categories) && $pieces[2] == 'slumpad' )
            {
                return 20;
            }
            
            return 0;
        }
        
        public function execute($uri)
        {
            $pieces = explode('/', $uri);
            $category = $pieces[1];
            
            $item = Entertain::fetch(
                array(
                    'category' => $category,
                    'order_by' => 'RAND()',
                    'limit' => 1,
                    'status' => 'released'
                )
            );
            
            $this->redirect = sprintf('/%s/%s', $category, $item->get('handle'));
        }
    }
?>