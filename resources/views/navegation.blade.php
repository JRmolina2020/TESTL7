<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="fi fi-phone"></i>
        <p>
        Operaciones
          <i class="right fi fi-more-v-a"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('medidas') }}" class="nav-link">
              <i class="fi fi-male"></i>
              <p>
                Medidas
              </p>
            </a>
          </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('marcas') }}" class="nav-link">
              <i class="fi fi-persons"></i>
              <p>
                Marcas
              </p>
            </a>
          </li>
      </ul>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('categorias') }}" class="nav-link">
              <i class="fi fi-persons"></i>
              <p>
                Categorias
              </p>
            </a>
          </li>
      </ul>
    </li> 
    <li class="nav-item">
      <a href="{{ url('productos') }}" class="nav-link">
        <i class="fi fi-file-1"></i>
        <p>Productos</p>
      </a>
    </li>
  </ul>
</nav>