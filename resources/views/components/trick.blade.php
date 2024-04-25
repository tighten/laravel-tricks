<article class="overflow-hidden rounded-lg bg-white shadow">
  <div class="px-4 py-5 sm:p-6">
    <a href="{{ route('tricks.show', $trick) }}">{{ $trick->name }}</a>
    <p class="text-sm leading-6 text-gray-600">{{ $trick->description }}</p>
    <div class="text-sm">
        <time datetime="{{ $trick->created_at->format('Y-m-d') }}" class="text-gray-500">{{ $trick->created_at->format('M d, Y') }}</time>
    </div>
    <a href="#">{{ $trick->user->name }}</a>
  </div>
</article>
