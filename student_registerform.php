<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes pulse-custom {
      from {
        transform: scale(0.9);
        opacity: 1;
      }
      to {
        transform: scale(1.8);
        opacity: 0;
      }
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-900 text-white">

  <form
    id="showform2"
    class="flex flex-col gap-3 max-w-[350px] w-full p-5 rounded-2xl border border-gray-700 bg-[#1a1a1a] relative"
    onsubmit="return validatePasswords()"

  >
    <p class="text-[28px] font-semibold tracking-tight flex items-center pl-8 relative text-cyan-400">
      <span class="absolute left-0 w-4 h-4 rounded-full bg-cyan-400"></span>
      <span class="absolute left-0 w-4 h-4 rounded-full bg-cyan-400 animate-[pulse-custom_1s_linear_infinite]"></span>
      Register
    </p>

    <p class="text-sm text-white/70">Signup now and get full access to our app.</p>

    <div class="flex w-full gap-2">
      <label class="relative w-1/2">
        <input type="text" name="firstname" required minlength="2" placeholder=" " class="bg-gray-800 text-white w-full py-5 pt-5 px-3 rounded-lg border border-gray-600 focus:outline-none peer placeholder-transparent" />
        <span class="absolute left-3 top-0 text-white/50 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm peer-focus:text-cyan-400 font-medium">Firstname</span>
      </label>

      <label class="relative w-1/2">
        <input type="text" name="lastname" required minlength="2" placeholder=" " class="bg-gray-800 text-white w-full py-5 pt-5 px-3 rounded-lg border border-gray-600 focus:outline-none peer placeholder-transparent" />
        <span class="absolute left-3 top-0 text-white/50 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm peer-focus:text-cyan-400 font-medium">Lastname</span>
      </label>
    </div>

    <label class="relative">
      <input type="email" name="email" required placeholder=" " class="bg-gray-800 text-white w-full py-5 pt-5 px-3 rounded-lg border border-gray-600 focus:outline-none peer placeholder-transparent" />
      <span class="absolute left-3 top-0 text-white/50 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm peer-focus:text-cyan-400 font-medium">Email</span>
    </label>

    <label class="relative">
      <input type="password" name="password" id="password" required minlength="6" placeholder=" " class="bg-gray-800 text-white w-full py-5 pt-5 px-3 rounded-lg border border-gray-600 focus:outline-none peer placeholder-transparent" />
      <span class="absolute left-3 top-0 text-white/50 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm peer-focus:text-cyan-400 font-medium">Password</span>
    </label>

    <label class="relative">
      <input type="password" name="confirm_password" id="confirm_password" required placeholder=" " class="bg-gray-800 text-white w-full py-5 pt-5 px-3 rounded-lg border border-gray-600 focus:outline-none peer placeholder-transparent" />
      <span class="absolute left-3 top-0 text-white/50 text-sm transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm peer-focus:text-cyan-400 font-medium">Confirm Password</span>
    </label>

    <p id="error-message" class="text-red-500 text-sm hidden">Passwords do not match.</p>

    <button type="submit" class="bg-cyan-400 text-white font-medium py-2 px-4 rounded-lg hover:bg-cyan-300 transition-colors">
      Submit
    </button>

    <p class="text-sm text-center text-white/70">
      Already have an account?
      <a onclick="removehidden()" class="text-cyan-400 hover:underline hover:decoration-cyan-500 cursor-pointer">Signin</a>
    </p>
  </form>
<!-- next form -->
  <div id="showform" class="flex items-center hidden justify-center h-screen  from-blue-100 via-blue-400 to-blue-800">

<div
  class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md"
>
  <div
    class="relative mx-4 -mt-6 mb-4 grid h-28 place-items-center overflow-hidden rounded-xl bg-gradient-to-tr from-cyan-600 to-cyan-400 bg-clip-border text-white shadow-lg shadow-cyan-500/40"
  >
    <h3
      class="block font-sans text-3xl font-semibold leading-snug tracking-normal text-white antialiased"
    >
      Sign In
    </h3>
  </div>
  <form  >
  <div class="flex flex-col gap-4 p-6 h-[15rem]">
    <div class="relative h-11 w-full min-w-[200px]">
      <input
        name="email"
        placeholder=""
        class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-cyan-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 "
        type="email"
        
        required
        />
      <label
        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-cyan-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-cyan-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-cyan-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
      >
        Email
      </label>
    </div>
    <div class="relative h-11 w-full min-w-[200px]">
      <input
       name="password"
        placeholder=""
        class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-cyan-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
       
        required
        />
      <label
        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-cyan-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-cyan-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-cyan-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
      >
        Password
      </label>
    </div>
  
  </div>
  <div class="p-6 pt-0">

    <button
      data-ripple-light="true"
      type="submit"
  
      class="block w-full select-none rounded-lg bg-gradient-to-tr from-cyan-600 to-cyan-400 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg hover:shadow-cyan-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
      
      >
      Sign In
    </button>
     <p class="text-sm text-center text-bg-dark p-2 ">
      dont have account.
      <a onclick="removehidden(false)"  class="text-red-500 hover:underline hover:decoration-cyan-500 cursor-pointer">Signin</a>
    </p>
  
   
  </div>
</div>
</form>

</body>

  <script>
    function validatePasswords() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const errorMessage = document.getElementById('error-message');

      if (password !== confirmPassword) {
        errorMessage.classList.remove('hidden');
        return false;
      }

      errorMessage.classList.add('hidden');
      return true;
    }

   function removehidden(a=true){
    let show= document.getElementById('showform');
    let show2=document.getElementById('showform2');
    if(a==true){
    show.classList.remove('hidden');
    show2.classList.add('hidden');

    
}
else{
     show2.classList.remove('hidden');
    show.classList.add('hidden');
   
}
   }
  </script>
</body>
</html>
