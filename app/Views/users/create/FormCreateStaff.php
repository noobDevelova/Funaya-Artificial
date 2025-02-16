<form method="POST" id="createStaffForm">
    <?= csrf_field() ?>

    <div class="px-4 py-3 bg-white rounded-lg shadow-md  dark:bg-gray-800">
        <div class="flex flex-col space-y-2 mb-8">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Username</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Jane Doe" type="text"
                    name="username" value="<?= old('username') ?>" required />

                <span id="username-error" class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Role Staff
                </span>

                <select class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                        border border-gray-300bg-white text-gray-700 placeholder-gray-400 
                        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                        dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                        dark:focus:ring-gray-500 dark:focus:border-gray-500" name="role">
                    <span id="username-error" class="text-xs text-red-600 dark:text-red-400">
                    </span>">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role->id; ?>">
                            <?= $role->roleName; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <span id="role-error" class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Jane Doe" type="email"
                    name="email" value="<?= old('email') ?>" required />

                <span id="email-error" class="text-xs text-red-600 dark:text-red-400"></span>
            </label>

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Phone Number</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Jane Doe" type="tel"
                    name="phone_number" value="<?= old('phone_number') ?>" required />


                <span id="phone_number-error" class="text-xs text-red-600 dark:text-red-400"></span>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="***************" name="password"
                    type="password" required />

                <span id="password-error" class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Konfirmasi Password</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="***************"
                    name="confirm_password" type="password" required />

                <span id="confirm_password-error" class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>
        </div>

        <button
            class="block w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit">
            Buat Akun
        </button>
    </div>
</form>