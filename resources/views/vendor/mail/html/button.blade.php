@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="{{ $align }}">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="{{ $align }}">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td align="center" 
                                    bgcolor="#f59e0b" 
                                    style="border-radius: 12px; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.35); transition: all 0.2s ease-in-out;">
                                    <a href="{{ $url }}" 
                                       class="button button-{{ $color }}" 
                                       target="_blank" 
                                       rel="noopener" 
                                       style="font-family: 'Segoe UI', Arial, sans-serif; 
                                              font-size: 16px; 
                                              font-weight: 600; 
                                              color: #ffffff; 
                                              text-decoration: none; 
                                              padding: 14px 28px; 
                                              display: inline-block; 
                                              border: 1px solid #f59e0b; 
                                              border-radius: 12px;">
                                        {!! $slot !!}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>