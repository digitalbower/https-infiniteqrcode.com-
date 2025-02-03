
@extends('layouts.layout')
@section('title', 'My Qrcodes')
@section('content')

      <div class="mx-auto w-full lg:pl-72 space-y-6">
        <section class="my-8 mt-10 bg-gray-700 rounded-lg p-5">
            <h2 class="text-2xl font-semibold mb-4">My Folders</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4" id="foldersGrid">
              <!-- Folder Items -->
            </div>
          </section>
      
          <section class="bg-gray-800 rounded-lg shadow-lg">
            <div class="p-4 border-b border-gray-700 flex justify-between items-center">
              <div class="flex items-center space-x-2">
                <h2 class="text-lg font-semibold">QR Codes (79)</h2>
                <span class="text-gray-500">|</span>
                <button class="text-gray-400 hover:text-gray-200 flex items-center space-x-1">
                  <i class="fas fa-filter"></i>
                  <span>Filters</span>
                </button>
              </div>
              <div class="flex items-center space-x-4">
                <button class="text-blue-400 hover:text-blue-500 flex items-center space-x-1">
                  <i class="fas fa-tag"></i>
                  <span>Label</span>
                </button>
                <button class="text-blue-400 hover:text-blue-500 flex items-center space-x-1">
                  <i class="fas fa-download"></i>
                  <span>Download</span>
                </button>
                <button class="text-blue-400 hover:text-blue-500 flex items-center space-x-1">
                  <i class="fas fa-upload"></i>
                  <span>Bulk Upload</span>
                </button>
              </div>
            </div>
      
            <!-- QR Code Items -->
            <div class="divide-y divide-gray-700" id="qrCodesList">
              <!-- QR Code Items -->
            </div>
          </section>
      
          <!-- Pagination -->
          <div class="p-4 flex justify-between items-center" id="pagination">
            <button class="text-gray-400 hover:text-gray-200" id="prevPage">Previous</button>
            <span class="text-gray-400" id="pageInfo">Page 1</span>
            <button class="text-gray-400 hover:text-gray-200" id="nextPage">Next</button>
          </div>
    
         <!-- QR Code Items -->
         <div class="divide-y divide-gray-700">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Project Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Usage</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Date</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qrCodes as $qrCode)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-2 text-white">{{ $qrCode->projectname }}</td>
                            <td class="px-4 py-2 text-gray-400">{{ $qrCode->usage }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $qrCode->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $qrCode->qr_code_svg }}</td>
                           
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('mysms') }}" class="text-blue-400 hover:text-blue-500">View</a>
                                <a href="" class="text-blue-400 hover:text-blue-500">Download</a>
                                <form action="" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
      </div>
@endsection


