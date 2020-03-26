
<ul class="nav">
    <?php if(empty($menuSelected)) {
        $menuSelected = 'dashboard';
    } ?>
    <!-- Main menu -->
    
    <li class="{{ $menuSelected == 'dashboard' ? 'current' : '' }}"><a href="{{ URL::to('admin') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
    <li class="{{ $menuSelected == 'slider' ? 'current' : '' }}"><a href="{{ URL::to('slider') }}"><i class="glyphicon glyphicon-picture"></i> Front slider</a></li>
    <li class="{{ $menuSelected == 'category' ? 'current' : '' }}"><a href="{{ URL::to('category') }}"><i class="glyphicon glyphicon-calendar"></i> Categorii</a></li>
    <li class="{{ $menuSelected == 'users' ? 'current' : '' }}"><a href="{{ URL::to('users') }}"><i class="glyphicon glyphicon-user"></i> Useri</a></li>
    <li class="{{ $menuSelected == 'products' ? 'current' : '' }}"><a href="{{ URL::to('products') }}"><i class="glyphicon glyphicon-barcode"></i> Produse</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-list"></i> Tables</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
    <li class="submenu">
        <a href="#">
            <i class="glyphicon glyphicon-list"></i> Pages
            <span class="caret pull-right"></span>
        </a>
        <!-- Sub menu -->
        <ul>
            <li><a href="#">Login</a></li>
            <li><a href="#">Signup</a></li>
        </ul>
    </li>
</ul>

