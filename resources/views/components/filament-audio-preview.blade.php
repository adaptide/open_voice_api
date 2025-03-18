<div class="w-20 h-20 p-1">
    @use("App\Filament\Components\GoFileUpload")
    @use("\Illuminate\Support\Facades\Storage")
    <div class="relative size-full">
        <img
            src="{{ asset(auth()->user()->organization->logo ? 'storage/' . auth()->user()->organization->logo : 'default-music.png' ) }}"
            alt="Track Image"
            class="w-full h-full object-cover rounded-lg">

        @if ($getRecord()->path)
        <button
            x-data="{
                isPlaying: false,
                audio: new Audio('{{ Storage::disk('local')->url($getRecord()->path) }}'),
                playAudio() {
                    this.$wire.dispatch('stop-all-audio');
                    this.audio.play();
                    this.isPlaying = true;
                },
                stopAudio() {
                    this.audio.pause();
                    this.audio.currentTime = 0;
                    this.isPlaying = false;
                }
            }"
            x-init="
                this.audio = this.audio || new Audio('{{ Storage::disk('local')->url($getRecord()->path) }}');
                this.audio.addEventListener('ended', () => { isPlaying = false; });
                $wire.on('stop-all-audio', () => stopAudio());
            "
            x-on:click.stop.prevent="isPlaying ? stopAudio() : playAudio();"
            class="absolute inset-0 flex items-center justify-center">
            <div class="flex items-center justify-center w-4/6 h-4/6 rounded-full bg-gray-300 bg-opacity-25 dark:bg-gray-700 dark:bg-opacity-30 backdrop-blur-sm transition hover:bg-opacity-50 dark:hover:bg-opacity-60 focus:outline-none">
                <svg x-show="!isPlaying" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-white">
                    <path d="M3 22v-20l18 10-18 10z"></path>
                </svg>
                <svg x-cloak x-show="isPlaying" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-white">
                    <path d="M6 4h4v16h-4v-16zm8 0h4v16h-4v-16z"></path>
                </svg>
            </div>
        </button>
        @endif
    </div>
</div>
