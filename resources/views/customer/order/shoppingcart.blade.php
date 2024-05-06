<x-app-layout>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>
      
          <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
              <div class="space-y-6">
                <?php foreach ($cartItems as $item): ?>
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                  <!-- ... -->
                  <input type="text" id="counter-input" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="<?php echo $item->quantity; ?>" required />
                  <!-- ... -->
                  <p class="text-base font-bold text-gray-900 dark:text-white">$<?php echo $item->price; ?></p>
                  <!-- ... -->
                  <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white"><?php echo $item->name; ?></a>
                  <!-- ... -->
                </div>
                <?php endforeach; ?>
              </div>
            </div>
      
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
              <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>
      
                <div class="space-y-4">
                  <div class="space-y-2">
                    <dl class="flex items-center justify-between gap-4">
                      <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">$<?php echo $orderSummary->originalPrice; ?></dd>
                    </dl>
                    <!-- ... -->
                  </div>
      
                  <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                    <dd class="text-base font-bold text-gray-900 dark:text-white">$<?php echo $orderSummary->total; ?></dd>
                  </dl>
                </div>
                <!-- ... -->
              </div>
              <!-- ... -->
            </div>
          </div>
        </div>
      </section>
</x-app-layout>