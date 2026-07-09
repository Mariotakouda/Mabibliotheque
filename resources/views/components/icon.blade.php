@props(['name'])

@php
$paths = [
    'library' => '<path d="M4 21V7l5-3 5 3v14M4 21h16M4 21V10m16 11V10M9 21v-6h2v6M15 7.5 20 10v11" />',
    'home' => '<path d="m3 11 9-8 9 8" /><path d="M5 10v10h14V10" /><path d="M9 20v-6h6v6" />',
    'book' => '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v15.5H6.5A2.5 2.5 0 0 0 4 21V5.5Z" /><path d="M4 18.5A2.5 2.5 0 0 1 6.5 16H20" />',
    'tag' => '<path d="M12.5 3H6a2 2 0 0 0-2 2v6.5a2 2 0 0 0 .586 1.414l8.5 8.5a2 2 0 0 0 2.828 0l6.5-6.5a2 2 0 0 0 0-2.828l-8.5-8.5A2 2 0 0 0 12.5 3Z" /><path d="M8.5 8.5h.01" />',
    'swap' => '<path d="m17 2 4 4-4 4" /><path d="M3 11V9a4 4 0 0 1 4-4h14" /><path d="m7 22-4-4 4-4" /><path d="M21 13v2a4 4 0 0 1-4 4H3" />',
    'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />',
    'grid' => '<rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" />',
    'user-circle' => '<circle cx="12" cy="12" r="9" /><circle cx="12" cy="10" r="3" /><path d="M6.5 19.2a6 6 0 0 1 11 0" />',
    'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="m16 17 5-5-5-5" /><path d="M21 12H9" />',
    'login' => '<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" /><path d="m10 17 5-5-5-5" /><path d="M15 12H3" />',
    'user-plus' => '<path d="M13 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="7" cy="7" r="4" /><path d="M19 8v6" /><path d="M22 11h-6" />',
    'plus' => '<path d="M12 5v14" /><path d="M5 12h14" />',
    'pencil' => '<path d="M12 20h9" /><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />',
    'trash' => '<path d="M3 6h18" /><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" /><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" /><path d="M10 11v6" /><path d="M14 11v6" />',
    'eye' => '<path d="M1.5 12S5 5 12 5s10.5 7 10.5 7-3.5 7-10.5 7S1.5 12 1.5 12Z" /><circle cx="12" cy="12" r="3" />',
    'search' => '<circle cx="11" cy="11" r="7" /><path d="m21 21-4.3-4.3" />',
    'filter' => '<path d="M4 4h16l-6 8v6l-4 2v-8L4 4Z" />',
    'check-circle' => '<circle cx="12" cy="12" r="9" /><path d="m8.5 12.5 2.3 2.3L16 10" />',
    'alert-triangle' => '<path d="M10.3 3.6 1.9 18a1.6 1.6 0 0 0 1.4 2.4h17.4a1.6 1.6 0 0 0 1.4-2.4L13.7 3.6a1.6 1.6 0 0 0-2.8 0Z" /><path d="M12 9v4" /><path d="M12 16.5h.01" />',
    'clock' => '<circle cx="12" cy="12" r="9" /><path d="M12 7v5l3.5 2" />',
    'trending-up' => '<path d="m3 17 6-6 4 4 7-8" /><path d="M15 6h5v5" />',
    'photo' => '<rect x="3" y="4" width="18" height="16" rx="2" /><circle cx="8.5" cy="9.5" r="1.5" /><path d="m21 15-5-5-9 9" />',
    'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M3 10h18" />',
    'mail' => '<rect x="2.5" y="4.5" width="19" height="15" rx="2" /><path d="m3 6.5 9 6.5 9-6.5" />',
    'phone' => '<path d="M15.1 18.6a13.7 13.7 0 0 1-9.7-9.7l2.4-2a1.5 1.5 0 0 0 .4-1.7L6.9 2.3A1.5 1.5 0 0 0 5.2 1.5l-2.3.6C2.3 2.3 2 2.8 2 3.4 2 13.7 10.3 22 20.6 22c.6 0 1.1-.3 1.3-.9l.6-2.3a1.5 1.5 0 0 0-.8-1.7l-2.9-1.3a1.5 1.5 0 0 0-1.7.4l-2 2.4Z" />',
    'identification' => '<rect x="2.5" y="5" width="19" height="14" rx="2" /><circle cx="8.5" cy="12" r="2" /><path d="M6 16.2c.5-1 1.4-1.6 2.5-1.6s2 .6 2.5 1.6" /><path d="M14.5 9.5h4" /><path d="M14.5 13h4" />',
    'document-text' => '<path d="M6 3h9l5 5v13H6Z" /><path d="M15 3v5h5" /><path d="M9 13h6" /><path d="M9 17h6" /><path d="M9 9h2" />',
    'hashtag' => '<path d="M5 9h14" /><path d="M5 15h14" /><path d="m9 4-2 16" /><path d="m17 4-2 16" />',
    'lock' => '<rect x="4.5" y="10.5" width="15" height="10" rx="2" /><path d="M8 10.5V7a4 4 0 0 1 8 0v3.5" />',
    'menu' => '<path d="M4 6h16" /><path d="M4 12h16" /><path d="M4 18h16" />',
    'close' => '<path d="M18 6 6 18" /><path d="M6 6l12 12" />',
    'chevron-down' => '<path d="m6 9 6 6 6-6" />',
    'undo' => '<path d="M3 7v6h6" /><path d="M21 17a9 9 0 0 0-15.5-6.5L3 13" />',
    'arrow-right' => '<path d="M5 12h14" /><path d="m13 6 6 6-6 6" />',
    'info' => '<circle cx="12" cy="12" r="9" /><path d="M12 11v5.5" /><path d="M12 7.5h.01" />',
];
$path = $paths[$name] ?? $paths['info'];
@endphp

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
     {{ $attributes->merge(['class' => 'w-5 h-5']) }}>
    {!! $path !!}
</svg>
