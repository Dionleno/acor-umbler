<li class="{{ Request::is('categorias*') ? 'active' : '' }}">
    <a href="{!! route('categorias.index') !!}">
        <i class="fa fa-bookmark"></i>
        <span>Categorias</span>
    </a>
</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}">
        <i class="fa fa-newspaper-o"></i>
        <span>Materias</span>
    </a>
</li>

<li class="{{ Request::is('projetos*') ? 'active' : '' }}">
    <a href="{!! route('projetos.index') !!}">
        <i class="fa fa-line-chart"></i>
        <span>Projetos</span>
    </a>
</li>

<li class="{{ Request::is('videos*') ? 'active' : '' }}">
    <a href="{!! route('videos.index') !!}">
        <i class="fa fa-film"></i>
        <span>Videos</span>
    </a>
</li>

<li class="{{ Request::is('eventos*') ? 'active' : '' }}">
    <a href="{!! route('eventos.index') !!}">
        <i class="fa fa-calendar"></i>
        <span>Eventos</span>
    </a>
</li>

<li class="{{ Request::is('servicos*') ? 'active' : '' }}">
    <a href="{!! route('servicos.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Servicos</span>
    </a>
</li>

<li class="{{ Request::is('links*') ? 'active' : '' }}">
    <a href="{!! route('links.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Links</span>
    </a>
</li>
<li class="{{ Request::is('associados*') ? 'treeview menu-open' : 'treeview' }}">
    <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Associados</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="{{ Request::is('associados*') ? 'treeview-menu menu-item' : 'treeview-menu' }}" >
        <li class="{{ Request::is('associados/associado-beneficios') ? 'active' : '' }}">
            <a href="{!! route('associado-beneficios.index') !!}">
                <i class="fa fa-edit"></i>
                <span>Beneficios</span>
            </a>
        </li>

        <li class="{{ Request::is('associados/associado-planos') ? 'active' : '' }}">
            <a href="{!! route('associado-planos.index') !!}">
                <i class="fa fa-edit"></i>
                <span>Planos</span>
            </a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('club*') ? 'treeview menu-open' : 'treeview' }}">
    <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Club de desconto</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="{{ Request::is('club*') ? 'treeview-menu menu-item' : 'treeview-menu' }}" >
        <li class="{{ Request::is('club/beneficios') ? 'active' : '' }}">
            <a href="{!! route('beneficios.index') !!}">
                <i class="fa fa-edit"></i>
                <span>Beneficios</span>
            </a>
        </li>

        <li class="{{ Request::is('club/planos') ? 'active' : '' }}">
            <a href="{!! route('planos.index') !!}">
                <i class="fa fa-edit"></i>
                <span>Planos</span>
            </a>
        </li>
    </ul>
</li>