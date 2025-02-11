
@extends('layouts.layout')
@section('title', 'Subscription')
@section('content')
       <!-- Main Content Area -->
       <main class="lg:flex-1 overflow-y-auto p-4 lg:ml-64">
        <div class="container mx-auto lg:pt-12 sm:px-0 lg:px-6 sm:px- lg:px-12 space-y-8">
          <!-- Current Subscription Status -->
          <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg overflow-hidden ">
            <div class="md:p-6 p-2 ">
              <h2 class="text-2xl font-bold text-gray-100 mb-2">Your Current Subscription</h2>
              <p class="text-gray-400 mb-6">Details of your active subscription plan.</p>
              <div class="flex items-start justify-between mb-6">
                <div>
                  <h3 class="text-3xl font-bold text-gray-100">{{ ucfirst($plans->plan) }} Plan</h3>
                  <p class="text-xl text-gray-400">${{$plans->price == '' ? '0' : $plans->price;}}/{{ $plans->duration == '' ? '7 days' : $plans->duration; }}</p>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300" onclick="location.href='upgrade';">Upgrade</button>
              </div>
              @if ($plans->plan == 'free')
                <div class="flex gap-6 mb-6">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-days text-gray-400"></i>
                    <span class="text-sm">Start Date: {{ date('F j, Y', strtotime($plans->created_at )) }}</span>
                    <input type="hidden" id="payment_method_id" value="{{ $plans->payment_intent_id }}">
                  </div>
                  <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-days text-gray-400"></i>
                    <span class="text-sm">Next Billing: {{ date('F j, Y', strtotime($plans->created_at . ' +7 days')) }}</span>
                  </div>
                </div>
              @else
              <div class="flex gap-6 mb-6">
                <div class="flex items-center gap-2">
                  <i class="fas fa-calendar-days text-gray-400"></i>
                  <span class="text-sm">Start Date: {{ date('F j, Y', strtotime($plans->subscription_start)) }}</span>
                  <input type="hidden" id="payment_method_id" value="{{ $plans->payment_intent_id }}">
                </div>
                <div class="flex items-center gap-2">
                  <i class="fas fa-calendar-days text-gray-400"></i>
                  <span class="text-sm">Next Billing: {{date('F j, Y', strtotime($plans->subscription_end))}}</span>
                </div>
              </div>
              @endif
              <div class="bg-blue-900 border border-blue-700 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                  <i class="fas fa-exclamation-circle text-blue-400 mt-1 mr-3"></i>
                  @if ($plans->plan == 'free')
                    <div>
                      <h4 class="text-blue-100 font-semibold">Upgrade Your QR Code Experience</h4>
                      <p class="text-blue-200"> You're currently on the Free Plan. Upgrade to create and manage more QR codes with extended features! </p>
                    </div>
                  @elseif ($plans->plan == 'basic')
                    <div>
                      <h4 class="text-blue-100 font-semibold">Upgrade Your QR Code Experience</h4>
                      <p class="text-blue-200"> You're currently on the Basic Plan. Upgrade before {{ date('F j, Y', strtotime($plans->subscription_end)) }} to unlock advanced features and manage more QR codes! </p>
                    </div>
                 @elseif ($plans->plan == 'pro')
                    <div>
                      <h4 class="text-blue-100 font-semibold"> Reach the Top with Expert Plan.</h4>
                      <p class="text-blue-200"> You're on the Pro Plan. Upgrade before [{{ date('F j, Y', strtotime($plans->subscription_end)) }}] to enjoy the ultimate features and unlimited QR code management with the Expert Plan! </p>
                    </div> 
                  @elseif ($plans->plan == 'expert')
                    <div>
                      <h4 class="text-blue-100 font-semibold"> Stay at the Top! </h4>
                      <p class="text-blue-200"> You're on the highest plan—Expert. Renew before [{{ date('F j, Y', strtotime($plans->subscription_end)) }}] to continue enjoying premium features and unlimited flexibility! </p>
                    </div>
                 @endif
  
                </div>
              </div>
  
              @if ($plans->plan != 'free')
                <div class="flex items-center justify-between mb-6">
                  <div>
                    <label for="auto-renew" class="text-gray-100 font-medium">Enabled auto-renew</label>
                    <p class="text-sm text-gray-400">
                      Your subscription will automatically renew when it expires
                    </p>
                  </div>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="1" class="sr-only peer" id="autorenew" {{$plans->renew_status }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                  </label>
                </div>
              @endif
  
              @if ($plans->renew_status == 'disabled' && $plans->plan != 'free')
                <div>
                  <label for="auto-renew" class="text-gray-100 font-medium"> Autorenew Disabled </label>
                  <p class="text-sm text-gray-400">
                    Your auto-renew option is disabled. Renew your plan before [{{ date('F j, Y', strtotime($plans->subscription_end)) }}] to continue enjoying uninterrupted access to all features and benefits.
                  </p>
                </div>
              @endif
  
              @if ($plans->renew_status == 'disabled' && $plans->subscribe_status == 'Active' && $plans->plan != 'free')
                <div>
                  <label for="auto-renew" class="text-gray-100 font-medium"> Reactivate Your Plan Today </label>
                  <p class="text-sm text-gray-400">
                    Your plan has been canceled. Reactivate before [{{ date('F j, Y', strtotime($plans->subscription_end)) }}] to regain access to all features and benefits.
                  </p>
                </div>
              @endif
  
              @if ($plans->renew_status == 'disabled' && $plans->subscribe_status == 'Active')
                <div>
                  <label for="auto-renew" class="text-gray-100 font-medium"> Activate a Plan to Unlock Features </label>
                  <p class="text-sm text-gray-400">
                    Your current plan has expired or is inactive. Choose a plan today to access advanced features and manage your QR codes effortlessly.
                  </p>
                </div>
              @endif
  
                
              <input type="hidden" value="<?= $subscribe; ?>" id="subscribe" name="subscribe">
              <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 mt-3 {{ $plans->plan == 'free' ? 'hidden' : '';}}" id="cancel">
                <?php echo $subscribe == 'disabled' ? 'Reactivate' : 'Cancel'; ?> Subscription
              </button>
              <!-- Payment Methods -->
              <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg overflow-hidden {{ $plans->plan == 'free' ? 'hidden' : ''; }}" id="card-info">
                <div class="p-6">
                  <h2 class="text-2xl font-bold text-gray-100 mb-2">Payment Methods</h2>
                  <p class="text-gray-400 mb-6">Manage your payment methods</p>
                  <div class="grid gap-4 md:grid-cols-2">
                    <div class="bg-gray-700 border border-gray-600 rounded-lg p-4" id="multicard">
                   
                    </div>
                    <div class="border border-dashed border-gray-600 bg-gray-700 rounded-lg p-4" id="addcard">
                      <button id="openModalBtn" class="w-full h-full flex items-center justify-center text-gray-400 hover:text-gray-100 hover:bg-gray-600 transition duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Card
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Billing History -->
              <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg overflow-hidden {{$plans->plan == 'free' ? 'hidden' : ''; }}">
                <div class="p-6">
                  <h2 class="text-2xl font-bold text-gray-100 mb-2">Billing History</h2>
                  <p class="text-gray-400 mb-6">View your past transactions</p>
                  <div class="overflow-x-auto">
                    <table class="w-full">
                      <thead>
                        <tr class="border-b border-gray-700">
                          <th class="text-left py-3 px-4 text-gray-400">Plan Start</th>
                          <th class="text-left py-3 px-4 text-gray-400">Plan End</th>
                          <th class="text-left py-3 px-4 text-gray-400">Amount</th>
                          <th class="text-left py-3 px-4 text-gray-400">Invoice</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                            <tr class="border-b border-gray-700">
                              <td class="py-3 px-4 text-gray-300">{{ date('F j, Y', strtotime($plans->subscription_start)) }}</td>
                              <td class="py-3 px-4 text-gray-300"><?php echo date('F j, Y', strtotime($plans->subscription_end)); ?></td>
                              <td class="py-3 px-4 text-gray-300">{{$plans->price}}</td>
                              <td class="py-3 px-4">
                                <a href="{{$plans->ReceiptURL}}" target="_blank" class="text-blue-400 hover:text-blue-300 transition duration-300">
                                  <i class="fas fa-download mr-2"></i>
                                  Download
                                </a>
                              </td>
                            </tr>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
      </main>
      <div
        id="modalOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative">
          <!-- Close Button -->
          <button
            id="closeModalBtn"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">
            &times;
          </button>
          <h2 class="text-xl font-semibold text-gray-800">Enter Card Details</h2>
          <p class="text-gray-600 mt-1">Fill in the form below to add your card.</p>
          <!-- Card Form -->
          <form id="cardForm" class="mt-4" action="#" method="post" onsubmit="return false;">
            <div class="mb-4">
              <label for="cardName" class="block text-sm font-medium text-gray-700">
                Cardholder Name
              </label>
              <input
                type="text"
                id="cardName" readonly
                name="cardName" value="{{Session::get('firstname')}} {{Session::get('lastname')}}"
                class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-500"
                placeholder="John Doe"
                required>
              <input type="hidden" name="customerid" id="customer_id" value="<?= $plans->id; ?>">
              <input type="hidden" name="price" id="price" value="<?= $plans->price; ?>">
            </div>
            <div class="mb-4">
              <div id="card-element"></div>
            </div>
            <div id="card-errors" class="text-red-700"></div>
            <button
              type="submit"
              class="w-full bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 transition">
              Save Card
            </button>
          </form>
        </div>
      </div>
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    $(document).ready(function() {
      $("#cancel").on('click', function() {
        var sqb = $('#subscribe').val();
        if (sqb != 'disabled') {
          Swal.fire({
            title: "Are you sure?",
            text: " Do you want to cancel the Subscription now",
            icon: "info",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "POST",
                url: "bsave/renewsubscription",
                data: {
                  canceltype: "cancel"
                },
                dataType: "json",
                success: function(response) {
                  alert(response.success);
                  if (response.success) {
                    Swal.fire("Subscription Cancelled");
                    setTimeout(() => {
                      location.href = 'upgrade';
                    }, 2000);
                  } else if (!response.success) {
                    console.log(response.success);
                  }
                }
              });
            }
          });
        } else {
          Swal.fire({
            title: "Are you sure?",
            text: " Do you want to Reactivate the Subscription now",
            icon: "info",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "POST",
                url: "bsave/renewsubscription",
                data: {
                  canceltype: "Reactivate"
                },
                dataType: "json",
                success: function(response) {
                  alert(response.success);
                  if (response.success) {
                    Swal.fire("Subscription Cancelled");
                    setTimeout(() => {
                      location.href = 'upgrade';
                    }, 2000);
                  } else if (!response.success) {
                    console.log(response.success);
                  }
                }
              });
            }
          });
        }
      })
      $("#autorenew").change(function() {
        if ($(this).is(":checked")) {
          Swal.fire({
              title: "Are you sure?",
              text: " Do you want to Enable the Auto-renew Now",
              icon: "info",
              buttons: true,
              dangerMode: true,
              showCancelButton: true,
            })
            .then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: "bsave/renewsubscription",
                  data: {
                    canceltype: "enable"
                  },
                  success: function(response) {
                    alert(response.success);
                    if (response.success) {
                      Swal.fire("Subscription Auto renewal Enabled");
                      setTimeout(() => {
                        location.reload();
                      }, 2000);
                    } else {
                      console.log(response.success);
                    }
                  }
                });
              }
            });
          // Add your logic for ON state here
        } else {
          Swal.fire({
              title: "Are you sure?",
              text: " Do you want to Disable the Auto-renew Now",
              icon: "info",
              buttons: true,
              dangerMode: true,
              showCancelButton: true,
            })
            .then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: "bsave/renewsubscription",
                  data: {
                    canceltype: "disable"
                  },
                  success: function(response) {
                    alert(response.success);
                    if (response.success) {
                      Swal.fire("subscription Auto renewal Disabled");
                      setTimeout(() => {
                        location.reload();
                      }, 2000);
                    } else if (!response.success) {
                      //Swal.fire("No Subscription Found");
                      setTimeout(() => {
                        //location.href = 'upgrade';
                      }, 2000);
                    }
                  }
                });
              }
            });
          // Add your logic for OFF state here
        }
      });
    });
  </script>
  <script>
    document.querySelectorAll('input[name="card-default"]').forEach((radio) => {
  radio.addEventListener('change', (event) => {
    const selectedValue = event.target.value;
    console.log(`Default card changed to: ${selectedValue}`);
    // Add logic to handle backend updates if necessary
  });
});



    $(document).ready(function() {

      const customerid = $('#customer_id').val();

      //e.preventDefault();
      const paymentIntentId = $('#payment_method_id').val();
      $.ajax({
        url: 'fetch/paymentDetails.php', // Replace with your backend PHP file
        method: 'POST',
        data: {
          payment_intent_id: paymentIntentId,
          customer_id: customerid
        },
        dataType: 'json',
        success: function(response) {
          console.log(response.card.brand);
          if (response.success) {
            // Add card details display loop
            if(response.card.length>1){
              $('#addcard').addClass('hidden');
            }else{
              $('#addcard').removeClass('hidden');
            }
            response.card.forEach(card => {
              $/* ('#card-brand').text(card.brand);
              $('#card-last4').text(".... .... .... " + card.last4);
              $('#card-expiry').text("Expires " + card.exp_month + '/' + card.exp_year); */

               // Create card display element
              const cardElement = ` <div class="bg-gray-700 border border-gray-600 rounded-lg p-4">
      <div class="flex items-start gap-4">
        <div>
          <i class="fas fa-credit-card text-gray-400 text-xl"></i>
          <p class="text-sm font-normal text-gray-100">${card.brand}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-100">•••• •••• •••• ${card.last4}</p>
          <p class="text-xs text-gray-400">Expires ${card.exp_month}/${card.exp_year}</p>
        </div>
      </div>
      <div class="mt-4 text-right">
        <button
          class="set-default-btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition duration-300 disabled:bg-gray-500"
          data-card-id="${card.id}" ${card.default?'disabled':''} >
            ${card.default?'Default Card':'Set as Default'} 
        </button>
      </div>
    </div>  `;

              // Append card element to container
              $('#multicard').append(cardElement);
              $('#card-info').removeClass('hidden');
            });

            /* $('#card-brand').text(response.card.brand);
            $('#card-last4').text(".... .... .... " + response.card.last4);
            $('#card-expiry').text("Expires " + response.card.exp_month + '/' + response.card.exp_year);
            $('#card-info').removeClass('hidden'); */
          } else {
            //alert('Error: ' + response.message);
            $('#card-info').addClass('hidden');
          }
        },
        error: function(xhr, status, error) {
          alert('AJAX Error: ' + error);
        },
      });

      $(document).on('click', '.set-default-btn', function () {
  const cardId = $(this).data('card-id');
  
  // Add visual feedback to indicate the selected default card
  $('.bg-gray-700').removeClass('border-blue-600');
  $(this).closest('.bg-gray-700').addClass('border-blue-600');

  console.log(`Default card set to: ${cardId}`);

  updateDefaultCard(cardId,customerid);
});

function updateDefaultCard(cardId,customerid) {
    // Make an API call to update the default card
    $.ajax({
      url: "bsave/update-default-card", // Replace with the correct endpoint
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({ "cardId":cardId,"customerid":customerid }),
      success: function (response) {
        if (response.success) {
          Swal.fire("Default card updated successfully!");
          location.reload();
        } else {
          console.error("Failed to update default card:", response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error updating default card:", error);
      },
    });
  }



    });
  </script>
  <script>
    const stripe = Stripe("pk_test_51Q4eUWLg6tc3IU2sQ4eWvzve616nswfYJJNUniclSFdA3Sa2FvKwixWtBfzGCKDfyPdWXFj7Vt5GdJeBdzhOYdC4008NbbdB8a"); // Replace with your Stripe publishable key
    const clientSecret = 'client_secret_from_server';

    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const customerid = $('#customer_id').val();

    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modalOverlay = document.getElementById('modalOverlay');

    // Open Modal
    openModalBtn.addEventListener('click', () => {
      modalOverlay.classList.remove('hidden');
    });

    // Close Modal
    closeModalBtn.addEventListener('click', () => {
      modalOverlay.classList.add('hidden');
    });

    // Close modal when clicking outside
    modalOverlay.addEventListener('click', (e) => {
      if (e.target === modalOverlay) {
        modalOverlay.classList.add('hidden');
      }
    });

    // Handle Form Submission
    const cardForm = document.getElementById('cardForm');
    cardForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      try {
        // Step 1: Fetch Client Secret
        const clientSecretResponse = await fetch('bsave/create-payment-intent', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
        });

        if (!clientSecretResponse.ok) {
          throw new Error('Failed to fetch client secret');
        }

        const {
          clientSecret
        } = await clientSecretResponse.json();

        // Step 2: Confirm Card Setup
        const username = document.getElementById('cardName').value;
        const {
          setupIntent,
          error
        } = await stripe.confirmCardSetup(clientSecret, {
          payment_method: {
            card: card,
            billing_details: {
              name: username
            },
          },
        });

        if (error) {
          $("#card-errors").text(error.message);
          throw error;
        }


        // Step 3: Save Payment Method
        const saveResponse = await fetch('bsave/save-payment-card', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            customerid: customerid,
            amount: $('#price').val(),
            paymentMethodId: setupIntent.payment_method,

          }),
        });

        if (!saveResponse.ok) {
          const errorData = await saveResponse.json();
          $("#card-errors").text(errorData.error);
          throw new Error('Failed to save card details');
        }

        const saveResult = await saveResponse.json();
        alert('Card saved successfully: ' + saveResult.message);

        // Close modal
        modalOverlay.classList.add('hidden');
      } catch (err) {
        console.error(err);
        $("#card-errors").text(err.message || 'An unexpected error occurred');
      }
    });
 
  

</script>

@endsection