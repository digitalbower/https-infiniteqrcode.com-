
@extends('layouts.layout')
@section('title', 'My Qrcodes')
@section('content')

     
    <div class="mx-auto lg:p-0 sm:p-4 w-full lg:pl-72 space-y-6">
      <section class="my-8 mt-10 bg-gray-700 rounded-lg p-5">
        <h2 class="text-2xl font-semibold mb-4">My Folders</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4" id="foldersGrid">
          @forelse ($folders  as $folder)
          <div class="bg-gray-800 hover:bg-gray-700 rounded-lg shadow p-4 transition duration-200 foldersGrid1" folder_name="{{$folder->name}}">
              <div class="flex justify-between items-start mb-3">
                <i class="fas fa-folder text-2xl text-blue-400"></i>
                <button class="text-gray-400 hover:text-gray-200">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
              </div>
              <h3 class="font-semibold text-white foldername">{{$folder->name ?? 'No Name'}}</h3>
              <p class="text-sm text-gray-400">QR Codes({{$folder->count ?? 'QR Codes(0)'}})</p>
              <p class="text-xs text-gray-500 mt-2">{{$folder->date ?? ''}}</p>
            </div>
          @empty
            <div class="p-4 flex flex-col justify-center items-center text-center">
              <div class="text-lg text-gray-500 mb-4">
                No QR Code Available. Start Creating Your First QR Code.
              </div>
              <div class="mt-4">
                <button class="p-4 bg-blue-600 text-white rounded hover:bg-blue-700" onclick="location.href='qroption.php'">
                  Create QR Code
                </button>
              </div>
            </div>
          @endforelse
          
        </div>
      </section>

      <section class="bg-gray-700 rounded-lg shadow-lg w-full">
        <div class="p-4 border-b border-gray-700  flex justify-between items-center">
          <div class="flex items-center space-x-2">
            <h2 class="lg:text-lg text-sm font-semibold">QR Codes (<span id="qrcount">{{count($qrCodes)}}</span>)</h2>
            <span class="text-gray-500">|</span>

          </div>
          <span class="message text-red-900"></span>

        </div>
        <!-- QR Code Items -->
        <div class="divide-y divide-gray-700" id="qrCodesList">

          <!-- QR Code Items -->
          @foreach ($qrCodes  as $qrCode)
          <div class="p-4 flex relative items-center hover:bg-gray-700" id="qr-{{$qrCode['code']}}">
            <input type="checkbox" class="mr-4 md:relative absolute top-5 md:top-0 md:left-0 left-5" />
            <div class="w-6 h-6 bg-gray-700 rounded flex items-center justify-center mr-4">
              <i class="fas fa-qrcode text-4xl text-gray-400"></i>
            </div>
            <div class="flex-1 w-auto">
               <a href='analytics.php?id=$qrCode["code"]'> <h3 class="font-medium text-white">{{$qrCode['projectname']}}</h3></a>
              <a href="{{$qrCode['url']}}" target="_blank" class="md:text-sm md:line-clamp-none line-clamp-1 max-w-[200px] text-[11px] text-blue-400 hover:underline">{{$qrCode['url']}}</a>
              <div class="flex items-center space-x-4 mt-1 text-sm text-gray-500">
                <span>{{$qrCode['qrtype']}}</span>
                <span>{{$qrCode['date']}}</span>
              </div>
            </div>
            <div class="ml-auto">
              <div class="flex justify-end">
                <button class="p-2 w-auto ml-auto text-xs md:text-base hover:bg-gray-600 bg-gray-400 mb-2 rounded">
                  <a href="qrbackend/qrcodes/{{$qrCode['code']}}.png" class="flex gap-x-2 items-center" download>
                    <i class="fas fa-download text-white"></i> Download
                  </a>
                </button>
              </div>
              <div class="flex items-center justify-end space-x-2">
                <input id="id" class="id" value="{{$qrCode['code']}}" type="hidden">
                <button class="p-2 ml-auto hover:bg-gray-600 text-right text-base rounded {{$qrCode['qrtype'] === 'Static' ? 'hidden' : ''}}" onclick="forward('{{$qrCode['url']}}', '{{$qrCode['code']}}')">
                  <i class="fas fa-edit text-gray-400"></i>
                </button>

                <button class="p-2 ml-auto hover:bg-gray-600 text-right text-base rounded deleteQrCode" data-value="$qrCode['qrtype']">
                  <i class="fas fa-trash text-gray-400"></i>
                </button>
                <button class="p-2 ml-auto hover:bg-gray-600 text-right text-base rounded" onclick="location.href='Style-QR-Code.php?id=$qrCode['qrtype']'">
                  <i class="fa-solid fa-palette text-gray-400"></i>
                </button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </section>
        <!-- Pagination -->
        <div class="py-4 flex justify-between items-center" id="pagination">
          <button class="py-2 px-6 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 "
            id="prevPage">Previous</button>
          <span class="text-gray-400" id="pageInfo"></span>
          <button
            class="py-2 px-10 rounded-lg bg-[#F5A623] bg-opacity-80 hover:bg-opacity-100 text-white font-semibold hover:bg-[#F5A623]"
            id="nextPage">Next</button>
      </div>



    </div>

    <script>
      let qrCodes;
      let folders;
      $(document).ready(function() {
       
        $(document).on('click', ".deleteQrCode", function(e) {
          e.preventDefault();
          const index = $(this).data('value');
          console.log(index);
          Swal.fire({
              text: "Are you sure you want to delete this QR Code?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              showCancelButton: true,
              confirmButtonText: 'Yes', // Change the button text here
              cancelButtonText: 'No'
            })
            .then((yes) => {
              if (yes.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: "fetch/deleteQr.php",
                  data: {
                    id: index
                  },
                  success: function(response) {
                    if (response == 'success') {
                      $(".message").text('Deleted Successfully').addClass('text-red-600');
  
                      // Remove the deleted QR code from the qrCodes array
                      qrCodes = qrCodes.filter(qr => qr.code !== index);
  
                      // Remove the QR code from the DOM
                      $(`#qr-${index}`).remove();
  
                      // Update the count
                      $("#qrcount").text(qrCodes.length);
  
                      // Optionally, re-render the QR codes list
                      renderQrCodes(qrCodes);
                    }
                  }
                });
              }
            });
  
  
  
  
        });
      });
  
      function dateConvert(dateString) {
        const date = new Date(dateString);
  
        const formattedDate = date.toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric',
          year: 'numeric'
        });
        return formattedDate;
      }
  
      let currentPage = 1;
      const itemsPerPage = 5;
      let totalItems;
      const qrCodesList = document.getElementById("qrCodesList");
      const pageInfo = document.getElementById("pageInfo");
      const prevPage = document.getElementById("prevPage");
      const nextPage = document.getElementById("nextPage");
  
      $('#foldersGrid').on('click', ' .foldersGrid1', function() {
      // Get the folder name from the clicked element
        renderQrCodes(qrCodes = []);
        var folder_name = $(this).attr('folder_name');  
        $.ajax({
          url: "{{route('folder_details')}}", // URL of the PHP script
          method: 'POST',
          data: {
            folder_name: folder_name,
            "_token": "{{ csrf_token() }}",
          },
          dataType: 'json',
          success: function(response) { 
            qrCodes = response; 
            $("#qrcount").text(qrCodes.length);
            renderQrCodes(qrCodes);

          }
        });
      });

  
      function renderQrCodes(qrCodes) {
        let qrcode = qrCodes;//.sort((a, b) => Number(a.id) - Number(b.id));
        // console.log(qrcode);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const paginatedItems = qrCodes.slice(startIndex, startIndex + itemsPerPage);
        qrCodesList.innerHTML = "";
  
        if (qrCodes.length === 0) {
          qrCodesList.innerHTML = `
        <div class="p-4 flex flex-col justify-center items-center text-center">
          <div class="text-lg text-gray-500 mb-4">
            No QR Code Available. Start Creating Your First QR Code.
          </div>
          <div class="mt-4">
            <button class="p-4 bg-blue-600 text-white rounded hover:bg-blue-700" onclick="location.href='qroption.php'">
              Create QR Code
            </button>
          </div>
        </div>
      `;
          return;
        } else {
          // Render the paginated items
          //paginatedItems.sort((a, b) => Number(b.id) - Number(a.id));
          paginatedItems.forEach((qr) => {
            // console.log(paginatedItems);
            if (qr.code !== '' && qr.id !== '') {
              qrCodesList.innerHTML += `
            <div class="p-4 flex relative items-center hover:bg-gray-700" id="qr-${qr.code}">
              <input type="checkbox" class="mr-4 md:relative absolute top-5 md:top-0 md:left-0 left-5" />
              <div class="w-6 h-6 bg-gray-700 rounded flex items-center justify-center mr-4">
                <i class="fas fa-qrcode text-4xl text-gray-400"></i>
              </div>
              <div class="flex-1 w-auto">
                 <a href='analytics.php?id=${qr.code}'> <h3 class="font-medium text-white">${qr.projectname}</h3></a>
                <a href="${qr.url}" target="_blank" class="md:text-sm md:line-clamp-none line-clamp-1 max-w-[200px] text-[11px] text-blue-400 hover:underline">${qr.url}</a>
                <div class="flex items-center space-x-4 mt-1 text-sm text-gray-500">
                  <span>${qr.qrtype}</span>
                  <span>${(qr.date)}</span>
                </div>
              </div>
              <div class="ml-auto">
                <div class="flex justify-end">
                  <button class="p-2 w-auto ml-auto text-xs md:text-base hover:bg-gray-600 bg-gray-400 mb-2 rounded">
                    <a href="qrbackend/qrcodes/${qr.code}.png" class="flex gap-x-2 items-center" download>
                      <i class="fas fa-download text-white"></i> Download
                    </a>
                  </button>
                </div>
                <div class="flex items-center justify-end space-x-2">
                  <input id="id" class="id" value="${qr.code}" type="hidden">
                  <button class="p-2 ml-auto hover:bg-gray-600 text-right text-base rounded ${qr.qrtype === 'Static' ? 'hidden' : ''}" onclick="forward('${qr.url}', '${qr.code}')">
                    <i class="fas fa-edit text-gray-400"></i>
                  </button>
  
                  <button class="p-2 ml-auto hover:bg-gray-600 text-right text-base rounded deleteQrCode" data-value="${qr.code}">
                    <i class="fas fa-trash text-gray-400"></i>
                  </button>
                  <button class="p-2 ml-auto hover:bg-gray-600 text-right text-base rounded" onclick="location.href='Style-QR-Code.php?id=${qr.code}'"}>
                    <i class="fa-solid fa-palette text-gray-400"></i>
                  </button>
                </div>
              </div>
            </div>
          `;
            }
          });
        }
  
        // Update pagination controls
        prevPage.disabled = currentPage === 1;
        nextPage.disabled = currentPage * itemsPerPage >= qrCodes.length;
        totalItems = qrCodes.length;
        renderPagination(currentPage, qrCodes.length, itemsPerPage);
  
  
  
      }
  
      function renderPagination(currentPage, totalItems, itemsPerPage) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
  
        // Validate input
        if (totalPages <= 1 || currentPage < 1 || currentPage > totalPages) return;
  
        // Clear existing pagination buttons
        pageInfo.innerHTML = '';
  
        // Update Previous Button
        prevPage.disabled = currentPage === 1;
        prevPage.classList.toggle('text-gray-400', currentPage === 1);
        prevPage.classList.toggle('text-blue-500', currentPage !== 1);
  
        // Add event listener for Previous Button
        prevPage.onclick = () => {
          if (currentPage > 1) {
            currentPage--;
            renderQrCodes(qrCodes.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage));
            renderPagination(currentPage, totalItems, itemsPerPage);
          }
        };
  
        // Update Next Button
        nextPage.disabled = currentPage === totalPages;
        nextPage.classList.toggle('text-gray-400', currentPage === totalPages);
        nextPage.classList.toggle('text-blue-500', currentPage !== totalPages);
  
        // Add event listener for Next Button
        nextPage.onclick = () => {
          if (currentPage < totalPages) {
            currentPage++;
            renderQrCodes(qrCodes.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage));
            renderPagination(currentPage, totalItems, itemsPerPage);
          }
        };
  
        // Calculate range of pages to display
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);
  
        if (endPage - startPage < 4) {
          if (startPage === 1) {
            endPage = Math.min(totalPages, startPage + 4);
          } else {
            startPage = Math.max(1, endPage - 4);
          }
        }
        // Add ellipsis and first page button if necessary
        if (startPage > 1) {
          pageInfo.appendChild(createPageButton(1, currentPage, qrCodes));
  
          const ellipsis = document.createElement('span');
          ellipsis.textContent = '...';
          ellipsis.classList.add('px-2', 'text-gray-500');
          pageInfo.appendChild(ellipsis);
        }
        // Add page number buttons
        for (let i = startPage; i <= endPage; i++) {
          pageInfo.appendChild(createPageButton(i, currentPage, qrCodes));
        }
        // Add ellipsis and last page button if necessary
        if (endPage < totalPages) {
          const ellipsis = document.createElement('span');
          ellipsis.textContent = '...';
          ellipsis.classList.add('px-2', 'text-gray-500');
          pageInfo.appendChild(ellipsis);
  
          pageInfo.appendChild(createPageButton(totalPages, currentPage, qrCodes));
        }
      }
      // Helper function to create a page button
      function createPageButton(page, currentPage, qrCodes) {
        const pageButton = document.createElement('button');
        pageButton.textContent = page;
        pageButton.classList.add('px-4', 'py-2', 'rounded', 'text-sm', 'font-medium', 'cursor-pointer', 'pgbtn');
        pageButton.classList.toggle('bg-blue-500', page === currentPage);
        pageButton.classList.toggle('text-white', page === currentPage);
        pageButton.classList.toggle('hover:bg-blue-100', page !== currentPage);
  
        pageButton.addEventListener('click', () => {
          currentPage = page;
          renderQrCodes(qrCodes.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage));
          renderPagination(currentPage, qrCodes.length, itemsPerPage);
        });
  
        return pageButton;
      } //renderQrCodes();
  
  
      function forward(url, id) {
        if (url.includes('email')) {
          location.href = "edit-emailqr/"+ id;
        } else if (url.includes('sms')) {
          location.href = "edit-smsqr/" + id;
        } else if (url.includes('wifi')) {
          location.href = "edit-wifiqr/" + id;
        } else if (url.includes('bitcoin')) {
          location.href = "edit-bitcoinqr/" + id;
        } else if (url.includes('pdf')) {
          location.href = "edit-pdfqr/" + id;
        } else if (url.includes('mp3')) {
          location.href = "edit-mp3qr/" + id;
        } else if (url.includes('image')) {
          location.href = "edit-imageqr/" + id;
        } else if (url.includes('app')) {
          location.href = "edit-appqr/" + id;
        } else if (url.includes('video')) {
          location.href = "edit-videoqr/" + id;
        } else if (url.includes('vcard')) {
          location.href = "edit-vcardqr/" + id;
        } else if (url.includes('url')) {
          location.href = "edit-urlqr/" + id;
        }else if (url.includes('social')) {
          location.href = "edit-socialqr/" + id;
        }
      }
    </script>
  
@endsection


