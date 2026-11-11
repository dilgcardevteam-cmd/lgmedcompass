{{ $updateTitle }}

Hello {{ $requesterName ?: 'Requester' }},

{{ $updateMessage }}

Request details
Reference: {{ $requestReference }}
Subject: {{ $requestSubject }}
Service: {{ $serviceType }}@if ($otherServiceType) — {{ $otherServiceType }}@endif
Status: {{ $status }}
@if ($dateNeeded)
Date needed: {{ $dateNeeded }}
@endif
@if ($latestComment)

Latest comment:
{{ $latestComment }}
@endif
@if ($deliverableLink || $hasDeliverableFiles)

Completion materials:
@if ($deliverableLink)
Shared deliverable: {{ $deliverableLink }}
@endif
@if ($hasDeliverableFiles)
Completed files are available on the private request tracking page.
@endif
@endif

View or track your request: {{ $trackingUrl }}

This is an automated update from LGMED Compass.
