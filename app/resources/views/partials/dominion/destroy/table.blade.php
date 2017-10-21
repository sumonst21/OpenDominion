<table class="table">
    <colgroup>
        <col>
        <col width="100">
        <col width="100">
    </colgroup>

    @foreach ($landTypesBuildingTypes as $landType => $buildingTypes)

        @if (empty($buildingTypes))
            @continue
        @endif

        <thead>
            <tr>
                <th colspan="3">{{ ucfirst($landType) }} <span class="small">(Barren: {{ number_format($landCalculator->getTotalBarrenLandByLandType($selectedDominion, $landType)) }})</span></th>
            </tr>
            <tr>
                <th>Building</th>
                <th class="text-center">Owned</th>
                <th class="text-center">Destroy</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($buildingTypes as $buildingType)
                <tr>
                    <td>
                        {{ ucwords(str_replace('_', ' ', $buildingType)) }}
                        {!! $buildingHelper->getBuildingImplementedString($buildingType) !!}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ $buildingHelper->getBuildingHelpString($buildingType) }}"></i>
                    </td>
                    <td class="text-center">
                        {{ $selectedDominion->{'building_' . $buildingType} }}
                        <small>
                            ({{ number_format((($selectedDominion->{'building_' . $buildingType} / $landCalculator->getTotalLand($selectedDominion)) * 100), 1) }}%)
                        </small>
                    </td>
                    <td class="text-center">
                        <input type="number" name="destroy[{{ $buildingType }}]" class="form-control text-center" placeholder="0" min="0" max="{{ $selectedDominion->{'building_' . $buildingType} }}" value="{{ old('destroy.' . $buildingType) }}" {{ $selectedDominion->isLocked() ? 'disabled' : null }}>
                    </td>
                </tr>
            @endforeach
        </tbody>

    @endforeach

</table>