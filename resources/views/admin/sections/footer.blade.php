  {{-- setting --}}
  @include('admin.sections.setting')

  <footer class="main-footer">
      <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
      </div>
      <div class="footer-right">
      </div>
  </footer>
  </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('back/assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('back/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('back/assets/js/page/index.js') }}"></script>
  @stack('js')

  <!-- Template JS File -->
  <script src="{{ asset('back/assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('back/assets/js/custom.js') }}"></script>

  <script src="{{ asset('back/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('back/assets/js/page/sweetalert.js') }}"></script>
  </body>


  </html>
