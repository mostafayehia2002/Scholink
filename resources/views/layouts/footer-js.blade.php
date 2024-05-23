     <!--start switcher-->
     <div class="switcher-wrapper">
         <div class="switcher-btn"><i class="bx bx-cog bx-spin"></i></div>
         <div class="switcher-body">
             <div class="d-flex align-items-center">
                 <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                 <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
             </div>
             <hr />
             <h6 class="mb-0">Theme Styles</h6>
             <hr />
             <div class="d-flex align-items-center justify-content-between">
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked />
                     <label class="form-check-label" for="lightmode">Light</label>
                 </div>
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode" />
                     <label class="form-check-label" for="darkmode">Dark</label>
                 </div>
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark" />
                     <label class="form-check-label" for="semidark">Semi Dark</label>
                 </div>
             </div>
             <hr />
             <div class="form-check">
                 <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault" />
                 <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
             </div>
             <hr />
             <h6 class="mb-0">Header Colors</h6>
             <hr />
             <div class="header-colors-indigators">
                 <div class="row row-cols-auto g-3">
                     <div class="col">
                         <div class="indigator headercolor1" id="headercolor1"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor2" id="headercolor2"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor3" id="headercolor3"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor4" id="headercolor4"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor5" id="headercolor5"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor6" id="headercolor6"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor7" id="headercolor7"></div>
                     </div>
                     <div class="col">
                         <div class="indigator headercolor8" id="headercolor8"></div>
                     </div>
                 </div>
             </div>
             <hr />
             <h6 class="mb-0">Sidebar Colors</h6>
             <hr />
             <div class="header-colors-indigators">
                 <div class="row row-cols-auto g-3">
                     <div class="col">
                         <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                     </div>
                     <div class="col">
                         <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--end switcher-->


     <!-- Bootstrap JS -->
     <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
     <!--plugins-->
     <script src="{{asset('assets/js/jquery.min.js')}}"></script>
     <script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
     <script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
     <script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
     <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
     <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

     @stack('js')
     <!--app JS-->
     <script src="{{asset('assets/js/index.js')}}"></script>
     <script src="{{asset('assets/js/app.js')}}"></script>


     {{-- Toster --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
             integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
             crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     @if (session('success'))
         <script>
             toastr.success("{{ session('success') }}");
         </script>
     @endif
     @if (session('error'))
         <script>
             toastr.error("{{ session('error') }}");
         </script>
     @endif
