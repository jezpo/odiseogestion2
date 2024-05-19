
<li class="has-sub">
    <a href="{{ url('users') }}">
        <i class="material-icons">people</i> <span>Usuarios</span>
    </a>
</li>

<li>
    <a href="{{ url('permissions') }}">       
        <i class="material-icons">lock</i> <span>Permisos</span>
    </a>
</li>

<li>
    <a href="{{ url('roles') }}">    
        <i class="material-icons">security</i><span>Roles</span>
    </a>
</li>

<li>
    <a href="{{ url('dashboard/documentos-reci') }}">
        <i class="material-icons">inbox</i>  <span>Documentos recibidos</span>
    </a>
</li>
<li>
    <a href="{{ url('dashboard/documentos-env') }}">
        <i class="material-icons">send</i> <span>Documentos enviados</span>
    </a>
</li>
<li>
    <a href="{{ url('/flujos/buscar') }}">
        <i class="material-icons">description</i> <span>Buscar Documento</span>
    </a>
</li>
<li>
    <a href="{{ url('/dashboard/flujo-tramites') }}">
        <i class="material-icons">sync_alt</i> <span>Flujo de trámite </span>
    </a>
</li>
<li>
    <a href="{{ url('/dashboard/flujo-documentos') }}">
        <i class="material-icons">description</i> <span>Flujo de documentos </span>
    </a>
</li>

<li>
    <a href="{{ url('/dashboard/tipo-tramites') }}">
        <i class="material-icons">assignment</i>  <span>Trámite</span>
    </a>
</li>
<li>
    <a href="{{ url('/dashboard/programas') }}">
        <i class="material-icons">school</i> <span>Unidad o carrera </span>
    </a>
</li>
{{--
<li class="has-sub active expand">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="material-icons">home</i>
        <span>Documentos</span>
    </a>
  
    <ul class="sub-menu">
        <li class="active">
            <a href="{{ route('recibidos.index') }}">
                <i class="fas fa-file"></i> Documentos Recibidos
            </a>
        </li>
        <li class="active">
            <a href="{{ route('documents.index') }}">
                <i class="fas fa-file"></i> Documentos Enviados
            </a>
        </li>
        <li>
            <a href="{{url('hermes/programas')}}">
                <i class="fas fa-graduation-cap"></i> Unidad o Carrera
            </a>
        </li>
        <li>
            <a href="{{url('hermes/flujotramite')}}">
                <i class="fas fa-retweet"></i> Flujo De Tramite
            </a>
        </li>
        <li>
            <a href="{{url('hermes/flujodocumentos')}}">
                <i class="fas fa-file-alt"></i> Flujo De Documentos
            </a>
        </li>
        <li>
            <a href="{{url('hermes/tipotramite')}}">
                <i class="fas fa-tasks"></i> Tipo De Tramite
            </a>
        </li>
    </ul>
</li>
<li class="has-sub active expand">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="material-icons">home</i>
        <span>Reportes</span>
    </a>
    <ul class="sub-menu" style="">
        <li class="active">
            <a href="{{ route('reports.index') }}">Reportes</a>
        </li>
    </ul>
</li>
--}}
