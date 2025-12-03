<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['error_message']) || isset($_SESSION['success_message'])) {
    $messageType = isset($_SESSION['error_message']) ? 'error' : 'success';
    $messageText = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : $_SESSION['success_message'];

    echo '
    <div id="toast-container" class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50 opacity-0 transition-opacity duration-300 ease-in-out delay-300">
        <div id="dynamic-toast" class="max-w-sm w-full bg-gray-300 shadow-lg rounded-lg pointer-events-auto transform translate-y-0 transition-all ease-in-out duration-500">
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="' . ($messageType === 'error' ? 'text-red-400' : 'text-green-400') . ' h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM12 10v4m0 0-1.5-1.5M12 6h.01"></path>
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm leading-5 font-medium text-black" id="toast-message">' . $messageText . '</p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button id="close-toast-btn" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150" onclick="closeToast()">
                                <svg class="h-5 w-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastContainer = document.getElementById("toast-container");
            toastContainer.style.opacity = "1";

            setTimeout(function() {
                closeToast();
            }, 4000);
        });

        function closeToast() {
            var toastContainer = document.getElementById("toast-container");
            toastContainer.classList.add("opacity-0", "translate-y-0");
            setTimeout(() => {
                toastContainer.parentNode.removeChild(toastContainer);
            }, 100); 
        }
    </script>';

    unset($_SESSION['error_message']);
    unset($_SESSION['success_message']);
}
