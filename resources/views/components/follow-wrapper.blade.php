@props(['user'])

<div x-data="follow" {{ $attributes }}>
    {{ $slot }}
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('follow', () => ({
            followersCount: {{ $user->followers()->count() }},
            following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},

            follow() {
                this.following = !this.following;
                axios.post('/follow/${{ $user->id }}').then(res => {
                    console.log(res.data);
                    this.followersCount = res.data.followersCount;
                }).catch(err => {
                    console.log(err)
                })
            }
        }))
    })
</script>
