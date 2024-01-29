<x-mail::message>
@if($members->count() > 0)
The following members have certificates that will expire in the next 3 months (or have already expired and not been updated). Please ensure this is corrected as soon as possible.

<x-mail::table>
| Name | CFR Cert Expiry | Clinical Cert Expiry | Manual Handling Cert Expiry | Garda Vetting Expiry |
| ----- | -------- | -------- | -------- | -------- |
@foreach($members as $member)
| {{ $member->name }} | @if($member->cfr_expires_on) {{ $member->cfr_expires_on->format('d/m/Y') }} @else No Date @endif | @if($member->cert_expires_on) {{ $member->cert_expires_on->format('d/m/Y') }} @else No Date @endif | @if($member->manual_handling_date) {{ $member->manual_handling_date->addYears(2)->format('d/m/Y') }} @else No Date @endif | @if($member->garda_vetting_date) {{ $member->garda_vetting_date->addYears(3)->format('d/m/Y') }} @else No Date @endif |
@endforeach
</x-mail::table>
@else
There are currently no members with expiring or expired certificates.
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
