{{-- paginacion con Paginación simple de Vue.js con Laravel --}}
<div class="pagination">
      <button class="btn btn-default" @click="{{ $function }}(pagination.prev_page_url)"
              :disabled="!pagination.prev_page_url">
          Anterior
      </button>
      <span>Pagina @{{pagination.current_page}} de @{{pagination.last_page}}</span>
      <button class="btn btn-default" @click="{{ $function }}(pagination.next_page_url)"
              :disabled="!pagination.next_page_url">Siguiente
      </button>
</div>