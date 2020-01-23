@if (count($errors) > 0 || session('success') || session('error'))
  <section class="container">
    <header class="py-3">
      <strong id="messages" class="p-2 pointer-cur mb-2 alert-danger" @click="hide()" title="Click to close">&#9932;</strong>
    </header>

  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
  @endif

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  </section>

  @push('bodyground')
  <script type="text/javascript">
    options.methods.hide = () => {
      document.querySelector('#messages').parentNode.parentNode.classList.add('hide-transition');

      setTimeout(() => {
        document.querySelector('#messages').parentNode.parentNode.remove();
      }, 1500);
    };
  </script>
  @endpush
@endif