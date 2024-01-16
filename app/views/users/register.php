<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- component -->
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
	<div class="relative py-3 sm:max-w-xl sm:mx-auto">
		<div
			class="absolute inset-0 bg-gradient-to-r from-pink-400 to-pink-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
		</div>
		<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
			<div class="max-w-md mx-auto">
				<div>
					<h1 class="text-2xl font-semibold">Hello! Welcome to WIKI</h1>
				</div>
				<form action="<?php echo URLROOT; ?>/users/register" method="post">
					<div class="divide-y divide-gray-200">
						<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
							<div class="relative">
								<input placeholder="First name"  id="Firstname" name="Firstname" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['first_name_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"/>
								
								<span class="text-red-500">
									<?php echo $data['first_name_err']; ?>
								</span>
								<span class="text-sm" type="text" name="" id="regFirstname"></span>
								
							</div>
							<div class="relative">
								<input placeholder="Last name"  id="Lastname" name="Lastname" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['last_name_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"  />
								
								<span class="text-red-500">
									<?php echo $data['last_name_err']; ?>
								</span>
								<span class="text-sm" type="text" name="" id="regLastname"></span>
							</div>
							<div class="relative">
								<input placeholder="Email Address"  id="Email" name="Email" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['email_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"/>
								
								<span class="text-red-500">
									<?php echo $data['email_err']; ?>
								</span>
								<span class="text-sm" type="text" name="" id="regEmail"></span>
							</div>
							<div class="relative">
								<input id="pass" name="PasswordHash" type="password"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['password_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>" placeholder="Password" />
								<span class="text-red-500">
									<?php echo $data['password_err']; ?>
								</span>
								<span class="text-sm" type="text" name="" id="rPasswordHash"></span>
							</div>
							<a href="<?php echo URLROOT ;?>/users/login" class="text-sm ml-2 hover:text-pink-600 cursor-pointer">You already have an account? Click here to login...</a>
							<div class="relative">
								<button type="submit" value="Register" id="submitBtn"
									class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">Register</button>
							</div>


						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
    const Firstname = document.getElementById('Firstname');
    const regFirstname = document.getElementById('regFirstname');
    const Lastname = document.getElementById('Lastname');
    const regLastname = document.getElementById('regLastname');
    const Email = document.getElementById('Email');
    const regEmail = document.getElementById('regEmail');
    const PasswordHash = document.getElementById('pass');
    const rPasswordHash = document.getElementById('rPasswordHash');
    let submitBtn = document.getElementById('submitBtn');

    const validFirstname = /^[a-zA-Z]{3,}$/;
    const validLastname = /^[a-zA-Z]{3,}$/;
    const validEmail = /^(([a-zA-Z]{1,})\d{1,}@[a-z]{1,}\.[a-z]{1,3}|[a-z]+@[a-z]+\.[a-z]{1,3})$/;
    const validpass = /^.{8,}$/;

    var isFormValid = () => validFirstname.test(Firstname.value)
        && validLastname.test(Lastname.value)
        && validEmail.test(Email.value)
        && validpass.test(PasswordHash.value);

    const updateButtonColor = () => {
        submitBtn.style.backgroundColor = isFormValid() ? 'green' : 'red';
    };

    submitBtn = !isFormValid();

    const updateValidity = (field, validation, errorElement, comment) => {
        const inputValue = field.value;
        if (validation.test(inputValue)) {
            errorElement.innerText = `${field.name} is Valid`;
            errorElement.style.color = 'green';
            errorElement.style.display = 'block';
        } else {
            errorElement.innerText = comment; 
            errorElement.style.color = 'red';
            errorElement.style.display = 'block';
        }
        submitBtn.disabled = !isFormValid(); 
        updateButtonColor();
    };

    // Firstname.addEventListener('input', () =>console.log(Firstname.value);  updateValidity(Firstname, validFirstname, regFirstname, 'at least 3 characters'));
	Firstname.addEventListener('input' , e=>{
		updateValidity(Firstname, validFirstname, regFirstname, 'at least 3 characters')
	})
    Lastname.addEventListener('input', () => updateValidity(Lastname, validLastname, regLastname, 'at least 3 characters'));
    Email.addEventListener('input', () => updateValidity(Email, validEmail, regEmail, 'Invalid email address'));
    PasswordHash.addEventListener('input', () => updateValidity(PasswordHash, validpass, rPasswordHash, 'at least 6 characters'));
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>

<!-- bg-pink-500 hover:bg-pink-600 -->