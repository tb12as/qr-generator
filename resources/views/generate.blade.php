<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate QR Code - tb12as</title>
    <link rel="icon" type="image/png" href="{{ asset('img/sy.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center">
    <div class="w-4/5 lg:w-1/4 md:w-1/2">
        <h1 class="text-xl font-bold mt-2 mb-5">Generate QR Code - tb12as</h1>
        <div class="m-2">
            <ul id="errors" class="my-2"></ul>
            <form id="form">
                <div class="mb-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="text">
                        Text
                    </label>
                    <textarea name="text" id="text"rows="5" placeholder="Text" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-gray-300"></textarea>
                </div>
                <div class="my-2">
                    <button
                        class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 text-sm px-4 rounded focus:outline-none focus:ring focus:ring-gray-300"
                        type="submit">Create QR</button>
                </div>
            </form>
        </div>

        <div class="m-2">
            <div id="result" class="mt-10"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('form')
            const textInput = document.getElementById('text')

            const result = document.getElementById('result')
            const errors = document.getElementById('errors');

            let loading = false;
            let oldValue = '';

            form.addEventListener('submit', (e) => {
                e.preventDefault()

                if (!loading && oldValue != textInput.value) {
                    generateQr(textInput.value)
                } else {
                    console.log('Dude, wait for the loading finish first, or please change the text')
                }
            })

            function generateQr(string) {
                loading = true

                axios.post("{{ route('qr.generate') }}", {
                        text: string
                    })
                    .then(res => {
                        result.innerHTML = ''
                        errors.innerHTML = ''

                        const img = document.createElement('img')
                        img.src = res.data.result
                        img.alt = res.data.text

                        oldValue = res.data.text

                        result.appendChild(img)
                    })
                    .catch(err => {
                        result.innerHTML = ''
                        errors.innerHTML = ''

                        if (err.response.status == 422) {
                            Object.values(err.response.data.errors).forEach(v => {
                                const li = document.createElement('li')
                                li.innerHTML = v
                                li.classList += 'text-red-600 font-semibold text-sm my-2';

                                errors.appendChild(li)
                            })
                        }
                    })
                    .finally(() => {
                        loading = false
                    })

            }

        })
    </script>
</body>

</html>
