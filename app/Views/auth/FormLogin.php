<form id="loginForm" class="w-full" method="POST">
    <?= csrf_field() ?>

    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
        Welcome Admin!
    </h1>

    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Email</span>
        <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Email" name="email" type="email"
            required />
        <span id="email-error" class="error-message text-xs text-red-600 dark:text-red-400"></span>
    </label>

    <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Password</span>
        <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" name="password" type="password"
            placeholder="Password" required />
        <span id="password-error" class="error-message text-xs text-red-600 dark:text-red-400"></span>
    </label>

    <span id="general-error" class="error-message text-xs text-red-600 dark:text-red-400"></span>
    <button type="submit"
        class="submit-button block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Log in
    </button>
</form>