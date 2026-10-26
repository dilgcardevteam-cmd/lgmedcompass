@props(['url'])
<tr>
    <td class="header" style="text-align: center;">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            @if (trim($slot) === 'Laravel' || trim($slot) === config('app.name'))
                <img src="https://www.image2url.com/r2/default/images/1776071231743-49d03bec-5709-4048-b6e8-42970050f04d.png" 
                     style="height: 188PX; width: auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));" 
                     alt="LGMED Compass Logo">
            @else
                <span style="color: #78350f; font-size: 24px; font-weight: bold;">{{ $slot }}</span>
            @endif
        </a>
    </td>
</tr>