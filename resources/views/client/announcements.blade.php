@include('partials.head', ['title' => 'Announcements'])

<script>
    function deletePost(e, id) {
        if (!confirm('Are you sure you want to delete this announcement?\nTHIS ACTION CANNOT BE REVERSED.')) {
            return;
        }
        const btn = e.target
        btn.disabled = true

        const uri = "{{ url('/announcements') }}/" + id;

        const requestOptions = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        };
        fetch(uri, requestOptions)
            .then((res) => {
                if (res.status !== 200) {
                    const msg = document.createElement('span')
                    msg.classList.add('alert')
                    msg.classList.add('error')
                    msg.textContent =
                        "The removal of the publication could not be completed, check the console for more information."
                    btn.parentNode.appendChild(msg);
                    console.log(res)
                } else {
                    const msg = document.createElement('span')
                    msg.classList.add('alert')
                    msg.classList.add('success')
                    msg.textContent =
                        "Post successfully deleted."
                    const nodeGod = btn.parentNode.parentNode;
                    nodeGod.innerHTML = "";
                    nodeGod.appendChild(msg);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<body>
    @include('partials.nav')
    <main>

        <h1 class="centered">Announcements</h1>

        @if (Auth::user()['role'] == 'admin')

            <form action="/say" method="POST">
                @csrf
                <h1>Create announcement </h1>
                <p>Create an announcement for all your customers, they will see the announcements in the [Announcements]
                    tab.
                </p>
                @if (session('response'))
                    <span class="alert {{ session('response')['type'] }}">
                        {{ session('response')['message'] }}
                    </span>
                @endif
                <hr>

                <div class="vertical-input">
                    <label for="title">Title</label>
                    <input required type="text" name="title" id="title" placeholder="Announcement title">

                </div>

                <div class="vertical-input">
                    <label for="content">Content</label>
                    <textarea required name="content" id="content" cols="30" rows="10"></textarea>
                </div>

                <hr>
                <input type="submit" value="Post">
            </form>
        @endif

        @if ($data)
            @foreach ($data as $post)
                <div class="post">
                    <h2>{{ $post['title'] }}</h2>
                    <span>{{ $post['created_at'] }}</span>
                    @foreach ($post['content'] as $paragraph)
                        <p>
                            {{ $paragraph }}
                        </p>
                    @endforeach

                    @if (Auth::user()['role'] == 'admin')
                        <div class="buttons">
                            <button onclick="deletePost(event,{{ $post['id'] }})">Remove</button>
                        </div>
                    @endif

                </div>
            @endforeach
        @else
            <p style="text-align: center;font-size: 15px;color: #9f9f9f;" class="messageCentered">
                There are no announcements yet.
            </p>
        @endif

        <br><br>
    </main>
</body>
