 <script>
     $(document).ready(function() {
         $('.btn-download').click(function(e) {
             // e.preventDefault();

             var sujetId = $(this).attr("data-id");
             var file = $(this).attr("data-file");


             $.ajax({
                 type: "GET",
                 url: "{{ route('download') }}",
                 data: {
                     sujetId: sujetId,
                     file: file
                 },
                 dataType: "json",
                 success: function(response) {
                     if (response.success == false) {
                         Swal.fire({
                             icon: "error",
                             title: "Oops...",
                             text: "Vous avez atteint le nombre de telechargement!",
                             // footer: '<a href="#">Why do I have this issue?</a>'
                         });
                     }
                 }
             });

         });
     });
 </script>
