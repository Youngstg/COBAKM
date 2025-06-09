<div id="splash-screen" class="fixed top-0 left-0 w-full h-full bg-white flex justify-center items-center z-50">
    <div class="text-white text-3xl flex flex-col justify-center">
        <img src="{{ asset('assets/images/km_logo_400x500.png') }}" alt="LogoKM"
            class="h-28 w-28 py-1 object-contain " />
    </div>
</div>

<script>
    setTimeout(() => {
        document.getElementById('splash-screen').style.display = 'none';
    }, 300);
</script>