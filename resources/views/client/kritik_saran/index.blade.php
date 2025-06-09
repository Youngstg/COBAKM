<x-client>
    <main class="bg-primary-beranda bg-no-repeat bg-cover py-32 m-4 rounded-2xl">
        <header class="flex flex-col mb-20">
            <h1
                class="text-left m-auto text-3xl md:text-4xl font-bold uppercase text-gasendra-blue-primary md:text-center lg:text-5xl">
                Kritik & Saran</h1>
        </header>
        <section class="w-auto md:w-[34rem] relative p-2 mx-auto rounded-xl lg:shadow-lg md:bg-opacity-50 bg-none">
            <form id="myForm"
                action="{{$kritik != null ? $kritik['link_dummy'] : 'https://script.google.com/macros/s/AKfycbw0GjNjspeua9H_LFyw70jhyqEt0_lfvBX96ocX8rM-R_PYiaHJM9NkGxfBKbzzc_2yCQ/exec'}}"
                method="post">
                <div class="my-2 flex flex-col max-w-lg mx-auto">
                    <label for="prodi" class="font-semibold text-xl text-gasendra-blue">Program Studi</label>
                    <input type="text" placeholder="Isikan Program Studi Anda" id="prodi" name="prodi"
                        class="placeholder-gray-500 placeholder:text-sm text-black border rounded-md focus:outline-none p-2 bg-transparant shadow-sm">
                </div>

                <div class="my-3 flex flex-col max-w-lg mx-auto">
                    <label for="kns" class="font-semibold text-xl text-gasendra-blue">Kritik & Saran</label>
                    <input type="text" placeholder="Isikan Kritik & Saran Anda" id="kns" name="kns"
                        class="placeholder-gray-500 placeholder:text-sm text-black border rounded-md focus:outline-none p-2 bg-transparant shadow-sm">
                </div>

                <div class="my-3 flex flex-col max-w-lg mx-auto">
                    <label for="referensi" class="font-semibold text-xl text-gasendra-blue">Link Referensi</label>
                    <input type="url" placeholder="Isikan Link Referensi Anda" id="referensi" name="referensi"
                        class="placeholder-gray-500 placeholder:text-sm text-black border rounded-md focus:outline-none p-2 bg-transparant shadow-sm">
                </div>

                <div class="max-w-lg mx-auto mb-2 mt-3">
                    <input type="submit" value="Submit"
                        class="bg-custom-blue cursor-pointer bg-gasendra-yellow-primary text-md py-2 px-5 text-white font-medium rounded-xl">
                </div>
            </form>
            <div id="myModal" class="modal text-slate-700 pl-2 md:mt-4 text-sm md:text-md border-none absolute"
                style="display:none;">
                <div class="modal-content">
                    <p id="modalMessage"></p>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Function to show the modal
        function showModal(message) {
            var modal = document.getElementById("myModal");
            var modalMessage = document.getElementById("modalMessage");

            // Set the message in the modal
            modalMessage.textContent = message;

            // Show the modal
            modal.style.display = "block";

            // Add event listener to close the modal when the close button is clicked
            setTimeout(function () {
                modal.style.display = "none";
            }, 2000)

            clearTimeout();
        }

        // Add event listener to the form submission
        document.getElementById("myForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Show the modal immediately to indicate form submission is in progress
            showModal("Sedang mengirim...");

            // Perform an AJAX request to submit the form
            var xhr = new XMLHttpRequest();
            xhr.open("POST", this.action);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Successful response
                        var response = xhr.responseText;
                        showModal(response); // Show the modal with the response message
                        document.getElementById("myForm").reset(); //Clear the form fields
                    } else {
                        // Error response
                        showModal("Error: Something went wrong."); // Show a generic error message
                    }
                }
            };
            xhr.send(new FormData(this));
        });
    </script>
</x-client>