<?php

class PaginaController
{
    public function about()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/menu.php';
        require_once 'views/layout/aside.php';
        require_once 'views/pagina/about.php';
        require_once 'views/layout/footer.php';
    }

    public function contact()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/menu.php';
        require_once 'views/layout/aside.php';
        require_once 'views/pagina/contact.php';
        require_once 'views/layout/footer.php';
    }
}
?>