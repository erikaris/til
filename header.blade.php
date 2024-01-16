<style>
    /* Style the modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Style the modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        font-weight: bold;
    }

    /* Style the close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Style for the hidden form container */
    .hidden-form {
        display: none; /* Change to 'none' when you want to hide it initially */
    }
</style>

<script>

    // function for login
    document.addEventListener("DOMContentLoaded", function () {
        initializeCaptcha();
    });

    // Function to initialize reCAPTCHA
    function initializeCaptcha() {
        console.log("Initializing reCAPTCHA...");

        // Render reCAPTCHA in the specified container
        grecaptcha.ready(function () {
            var captchaContainer = document.getElementById("captchaContainer");
            if (captchaContainer) {
                console.log("reCAPTCHA container found. Rendering reCAPTCHA...");

                window.recaptchaWidgetId = grecaptcha.render(captchaContainer, {
                    sitekey: '6LdRwUYpAAAAABu6MlraoB4jT0khPfij8lBeBxY5', // Replace with your reCAPTCHA site key
                    type: 'image', // Set the type to 'image' for image challenge
                });

                console.log("reCAPTCHA successfully rendered.");
            } else {
                console.error("Captcha container not found.");
            }
        });
    }

    // Function to verify reCAPTCHA on form submission
    function verifyCaptcha() {
        grecaptcha.execute(window.recaptchaWidgetId).then(function (token) {
            // Use the obtained token for server-side verification
            // For now, we'll just log it to the console
            console.log("reCAPTCHA Token:", token);

            // Proceed with login logic
            login();
        }).catch(function (error) {
            console.error("reCAPTCHA verification failed:", error);
            alert("reCAPTCHA verification failed. Please try again.");
            // Optionally, you can reset reCAPTCHA here
            grecaptcha.reset(window.recaptchaWidgetId);
        });
    }

    // Function to show the login popup
    function showLoginPopup() {
        // Reset email and password fields
        document.getElementById("emaill").value = "";
        document.getElementById("passwordl").value = "";

        // Show the login form
        document.getElementById("loginForm").style.display = "flex";
    }

    // Function to close the login popup and reset input fields
    function closeLoginPopup() {
        var loginForm = document.getElementById("loginForm");
        if (loginForm) {
            // Reset email and password fields
            document.getElementById("emaill").value = "";
            document.getElementById("passwordl").value = "";

            // Reset reCAPTCHA
            grecaptcha.reset(window.recaptchaWidgetId);

            // Hide the login form
            loginForm.style.display = "none";
        }
    }

    // Function to handle login (you can customize this according to your backend logic)
    function login() {
        // Add your login logic here
        // For example, you can validate the email and password, then perform a login request to your backend
        // After successful login, you can redirect the user to the desired page
    }

    // Function to handle registration form submission
    function submitRegistrationForm() {

        var myHeaders = new Headers();
        myHeaders.append("Acept", "application/json");

        var formdata = new FormData();

        formdata.append("fullName", document.getElementById("fullName").value);
        formdata.append("email", document.getElementById("email").value);
        formdata.append("companyName", document.getElementById("companyName").value);
        formdata.append("position", document.getElementById("position").value);
        formdata.append("phoneNumber", document.getElementById("phoneNumber").value);
        formdata.append("city", document.getElementById("city").value);
        formdata.append("password", document.getElementById("password").value);

        var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: formdata,
        redirect: 'follow'
        };

        fetch("http://localhost:8000/api/register", requestOptions)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display success message in a pop-up window
                    showSuccessPopup();
                    // console.log("Success popup function called");
                    // You may also redirect the user or perform other actions as needed
                } else {
                    // Display an error message
                    alert('Pendaftaran gagal. Silahkan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Pendaftaran gagal. Silahkan coba lagi.');
            });
    }

    // Function to show a success pop-up
    function showSuccessPopup() {
        // alert('Pendaftaran berhasil. Silahkan tunggu email dari kami untuk aktivasi akun')
        // Display the modal
        document.getElementById('registrationForm').style.display = 'none'; 
        document.getElementById('divregsuccess').style.display = 'block';

    }

    // Function to close the success pop-up
    function closeSuccessPopup() {
        // Close the modal
        document.getElementById('divregsuccess').style.display = 'none';
    }

    // function to show the registration
    function showRegistrationPopup() {
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("registrationForm").style.display = "flex";
        // Reinitialize reCAPTCHA when the registration form is shown
        initializeRecaptcha();
    }

    // Function to close the registration popup
    function closeRegistrationPopup() {
        var registrationForm = document.getElementById("registrationForm");
        if (registrationForm) {
            // Clear all input fields
            var inputFields = registrationForm.querySelectorAll("input");
            inputFields.forEach(function (input) {
                input.value = "";
            });

            // Reset reCAPTCHA
            grecaptcha.reset(window.recaptchaWidgetId);

            // Hide the registration form
            registrationForm.style.display = "none";
        }
    }

    // Function to initialize reCAPTCHA
    function initializeRecaptcha() {
        grecaptcha.ready(function () {
            var recaptchaContainer = document.getElementById("recaptchaContainer");
            if (recaptchaContainer) {
                // Render reCAPTCHA in the specified container
                window.recaptchaWidgetId = grecaptcha.render(recaptchaContainer, {
                    sitekey: '6LdRwUYpAAAAABu6MlraoB4jT0khPfij8lBeBxY5', // Replace with your reCAPTCHA site key
                });
            }
        });
    }

    // Function to toggle password visibility
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        if (passwordInput) {
            var type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
        }
    }

</script>

<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-black dark:text-yellow-300">
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-yellow"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- header: title and logo -->
        <div class="flex justify-center flex-1 lg:mr-32 flex-col items-center">
            <div class="flex items-center">
                <img src="assets/img/esdm_logo1.png" width="10%">
                <div class="ml-4 font-bold text-black">
                    KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL <br />
                    DIREKTORAT JENDERAL ENERGI BARU, TERBARUKAN, DAN KONSERVASI
                </div>
            </div>
            <div class="font-bold text-black mt-6 text-2xl">
                <h2>MONITORING INVESTASI SEKTOR BIOENERGI</h2>
            </div>
        </div>

        <!-- masuk/login -->
        <button type="button"
            onclick="showLoginPopup()"
            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-300 hover:bg-yellow-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
            Masuk/Login
        </button>

        <!-- Login form initially hidden -->
        <div id="loginForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-md shadow-md relative">

                <!-- 'X' symbol for close -->
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800" onclick="closeLoginPopup()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h2 class="text-2xl font-bold mb-4">Login</h2>

                <!-- 1. Statement -->
                <p class="mb-4">Silahkan masuk/login untuk melanjutkan</p>

                <!-- 2. Input field for email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="emaill" name="emaill" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 3. Input field for password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="passwordl" name="passwordl" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 4. Captcha (svg-captcha) -->
                <div class="mb-4" id="captchaContainer"></div>

                <!-- 5. Login button -->
                <button class="py-2 px-4 bg-yellow-300 hover:bg-yellow-400 text-white rounded-md" onclick="verifyCaptcha()">
                    Login
                </button>

                <!-- 6. Registration form for a new user -->
                <div class="mt-4">
                    <p>Belum memiliki akun? <a href="#" onclick="showRegistrationPopup()" class="text-blue-500">Daftar disini</a></p>
                </div>

                <!-- 7. Forget password -->
                <div class="mt-2">
                    <p><a href="forgot-password.html" class="text-blue-500">Lupa password</a></p>
                </div>

            </div>
        </div>

        <!-- Registration form initially hidden -->
        <div id="registrationForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-md shadow-md relative w-1/4 h-4/5 max-h-full overflow-y-auto">

                <!-- 'X' symbol for close in top right corner -->
                <button class="absolute top-5 right-2 text-gray-600 hover:text-gray-800" onclick="closeRegistrationPopup()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h2 class="text-2xl font-bold mb-4">Daftar Pengguna Baru</h2>

                <!-- 1. Form title -->
                <!-- <div class="mb-4">
                    <p>Daftar sebagai pengguna baru Monitoring Investasi Sektor Bioenergi</p>
                </div> -->

                <!-- 2. Input field for 'Nama Lengkap' -->
                <div class="mb-4">
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="fullName" name="fullName" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 3. Input field for 'Email' -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 4. Input field for 'Nama Perusahaan/Instansi' -->
                <div class="mb-4">
                    <label for="companyName" class="block text-sm font-medium text-gray-700">Nama Perusahaan/Instansi</label>
                    <input type="text" id="companyName" name="companyName" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 5. Input field for 'Jabatan/Posisi' -->
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Jabatan/Posisi</label>
                    <input type="text" id="position" name="position" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 6. Input field for 'Nomor Telepon (WA)' -->
                <div class="mb-4">
                    <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Nomor Telepon (WA)</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 7. Input field for 'Kota Domisili' -->
                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">Kota Domisili</label>
                    <input type="text" id="city" name="city" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <!-- 8. Input field for 'Kata Sandi' -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <div class="py-2" x-data="{ showPassword: true }">
                        <div class="relative">
                            <input placeholder="" :type="showPassword ? 'password' : 'text'" id="password" name="password"
                                class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                                required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg class="h-6 text-gray-700 cursor-pointer" fill="none" @click="showPassword = !showPassword"
                                    :class="{'hidden': !showPassword, 'block': showPassword }" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>
                                <svg class="h-6 text-gray-700 cursor-pointer" fill="none" @click="showPassword = !showPassword"
                                    :class="{'block': !showPassword, 'hidden': showPassword }" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07a32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 9. Input field for 'Ketik Kata Ulang Sandi' -->
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Ketik Kata Ulang Sandi</label>
                    <div class="py-2" x-data="{ showConfirmPassword: true }">
                        <div class="relative">
                            <input placeholder="" :type="showConfirmPassword ? 'password' : 'text'" id="confirmPassword"
                                name="confirmPassword"
                                class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                                required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg class="h-6 text-gray-700 cursor-pointer" fill="none"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    :class="{'hidden': !showConfirmPassword, 'block': showConfirmPassword }"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>
                                <svg class="h-6 text-gray-700 cursor-pointer" fill="none"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    :class="{'block': !showConfirmPassword, 'hidden': showConfirmPassword }"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07a32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 10. Space for reCAPTCHA -->
                <div class="mb-4" id="recaptchaContainer"></div>

                <!-- 11. Registration button -->
                <button class="py-2 px-4 bg-yellow-300 hover:bg-yellow-400 text-white rounded-md" onclick="submitRegistrationForm()">
                    Daftar
                </button>
            </div>
        </div>

        <!-- Modal for popup window containing successful message -->
        <div id="divregsuccess" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeSuccessPopup()">&times;</span>
                <p id="successMessage">Pendaftaran berhasil. <br /> 
                Silahkan tunggu email dari kami untuk aktivasi login.</p>
            </div>
        </div>

        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Notifications menu -->
            <li class="relative">
                <template x-if="isNotificationsMenuOpen">
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" @click.away="closeNotificationsMenu"
                        @keydown.escape="closeNotificationsMenu"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <span>Messages</span>
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                    13
                                </span>
                            </a>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <span>Sales</span>
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                    2
                                </span>
                            </a>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <span>Alerts</span>
                            </a>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
    </div>
</header>
