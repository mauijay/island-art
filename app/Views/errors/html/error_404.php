<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Errors.pageNotFound') ?> - Island Art Hawaiʻi</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb'
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-teal-50 flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <!-- Logo/Icon -->
        <div class="mb-8">
            <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>

        <!-- Error Content -->
        <div class="bg-white rounded-xl shadow-xl p-8 md:p-12">
            <h1 class="text-6xl md:text-8xl font-bold text-gray-200 mb-4">404</h1>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Page Not Found</h2>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Aloha! The page you're looking for seems to have drifted away like a leaf on the ocean breeze. 
                Let's get you back to discovering Hawaiian art.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?= base_url() ?>" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Return Home
                </a>
                
                <a href="javascript:history.back()" 
                   class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:text-gray-900 font-semibold rounded-lg transition-colors duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Go Back
                </a>
            </div>

            <!-- Additional Help -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-2">Need help finding something?</p>
                <a href="/contact" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                    Contact our team →
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                © <?= date('Y') ?> Island Art Hawaiʻi - Celebrating Pacific Island creativity
            </p>
        </div>
    </div>
</body>
</html>

