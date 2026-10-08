<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/infotech/">InfoTech</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Serviços</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuarios
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/infotech/cliente/listar">Listar</a></li>
              <li><a class="dropdown-item" href="/infotech/cliente/cadastro">Cadastrar</a></li>
            </ul>
          </li>
 
        </ul>

        <?php if (isset($_SESSION['usuario_logado'])): ?>
        <!-- Notificações (preenchidas pelo notificacao.js) -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item dropdown">
            <a class="nav-link position-relative px-3" href="#" id="btn_notificacoes" role="button"
               data-bs-toggle="dropdown" aria-expanded="false" title="Notificações">
              <i class="bi bi-bell fs-5"></i>
              <span id="notificacao_badge"
                    class="position-absolute translate-middle badge rounded-pill bg-danger" style="top: .65rem; left: 70%; font-size: .65rem;" hidden>0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0 shadow" aria-labelledby="btn_notificacoes" style="width: 320px;">
              <div class="px-3 py-2 border-bottom fw-semibold">Notificações</div>
              <ul id="notificacao_lista" class="list-group list-group-flush" style="max-height: 360px; overflow-y: auto;">
                <li class="list-group-item text-muted small text-center py-3">Carregando...</li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/infotech/logout" title="Sair"><i class="bi bi-box-arrow-right fs-5"></i></a>
          </li>
        </ul>
        <script src="/infotech/View/Includes/js/notificacao.js" defer></script>
        <?php endif; ?>

      </div>
    </div>
  </nav>

 <div class="container">