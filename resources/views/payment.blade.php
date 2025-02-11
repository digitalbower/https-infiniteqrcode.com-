<div class="col-span-7 px-4" id="right-section">
    <div class="max-w-4xl mx-auto p-2 py-4 md:p-6 bg-white mt-10 shadow-lg rounded-xl">
        <h2 id="plan-heading" class="text-xl text-black font-bold mb-4">Select Your Plan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <!-- Yearly Plan -->
            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-500 transition duration-300">
                <div class="text-lg font-semibold text-gray-800">Pay Yearly - Save 25%</div>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xl font-semibold text-gray-900" id="yearly">₹5000</span>
                    <span class="text-sm text-gray-600">Billed annually</span>
                </div>
                <label class="flex items-center mt-4 gap-3 p-4 border rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                    <input type="radio" name="billing" class="h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500" id="cyearly" value="yearly" data-price="5000" data-duration="365" />
                    <span class="text-sm text-gray-700">Select Yearly</span>
                </label>
            </div>

            <!-- Monthly Plan -->
            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-500 transition duration-300">
                <div class="text-lg font-semibold text-gray-800">Pay Monthly</div>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xl font-semibold text-gray-900" id="monthly">₹500</span>
                    <span class="text-sm text-gray-600">Billed monthly</span>
                </div>
                <label class="flex items-center mt-4 gap-3 p-4 border rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                    <input type="radio" name="billing" class="h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500" id="cmonthly" value="monthly" data-price="500" data-duration="30" />
                    <span class="text-sm text-gray-700">Select Monthly</span>
                </label>
            </div>
        </div>

        <!-- Hidden Inputs for Stripe -->
        <form id="payment-form" action="{{ route('stripe.payment') }}" method="POST">
            @csrf
            <input type="hidden" id="billingprice" name="price">
            <input type="hidden" id="duration" name="duration">
            <input type="hidden" id="plan" name="plan">
            <input type="hidden" id="name" name="name" value="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}">

            <button type="submit" class="mt-3 w-full rounded-lg bg-[#6c8ef6] bg-opacity-80 hover:bg-opacity-100 py-3 text-white text-lg font-semibold transition duration-300">
                Pay & Subscribe
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const radioButtons = document.querySelectorAll('input[name="billing"]');
    const priceInput = document.getElementById("billingprice");
    const durationInput = document.getElementById("duration");
    const planInput = document.getElementById("plan");

    radioButtons.forEach(radio => {
        radio.addEventListener("change", function () {
            priceInput.value = this.dataset.price;
            durationInput.value = this.dataset.duration;
            planInput.value = this.value;
        });
    });
});
</script>