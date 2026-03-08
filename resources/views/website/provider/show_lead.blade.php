@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Lead Details') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Lead Details') }}</h1>
                <div class="section-header-button">
                    <a href="{{ route('provider.leads') }}" class="btn btn-primary">{{ __('Back to Leads') }}</a>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Lead Information') }}</h4>
                                <span class="badge {{ $lead->status_badge }} badge-lg">{{ $lead->formatted_status }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">{{ __('Lead ID') }}</th>
                                                <td><strong>{{ $lead->lead_id }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Category') }}</th>
                                                <td>{{ ucfirst(str_replace('-', ' ', $lead->category->slug ?? 'N/A')) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Service Type') }}</th>
                                                <td>{{ $lead->service_type }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('ZIP Code') }}</th>
                                                <td>{{ $lead->zip_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('City') }}</th>
                                                <td>{{ $lead->location_city ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('State') }}</th>
                                                <td>{{ $lead->location_state ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Country') }}</th>
                                                <td>{{ $lead->location_country ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">{{ __('Status') }}</th>
                                                <td><span class="badge {{ $lead->status_badge }}">{{ $lead->formatted_status }}</span></td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Received On') }}</th>
                                                <td>{{ $lead->created_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Time Since') }}</th>
                                                <td>{{ $lead->created_at->diffForHumans() }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Views') }}</th>
                                                <td>{{ $lead->views_count }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Last Viewed') }}</th>
                                                <td>{{ $lead->last_viewed_at ? $lead->last_viewed_at->format('M d, Y h:i A') : 'Never' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                @if($lead->additional_details)
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h5>{{ __('Additional Details') }}</h5>
                                            <div class="alert alert-info">
                                                <p class="mb-0">{{ $lead->additional_details }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5>{{ __('Actions') }}</h5>
                                        
                                        @if($lead->status === 'new')
                                            <form action="{{ route('provider.leads.contacted', $lead->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-phone"></i> {{ __('Mark as Contacted') }}
                                                </button>
                                            </form>
                                        @elseif($lead->status === 'contacted')
                                            <form action="{{ route('provider.leads.converted', $lead->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-check-circle"></i> {{ __('Mark as Converted') }}
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Status Change Dropdown -->
                                        <div class="btn-group ml-2">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                {{ __('Change Status') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('provider.leads.update-status', $lead->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" name="status" value="new" class="dropdown-item">{{ __('New') }}</button>
                                                    <button type="submit" name="status" value="contacted" class="dropdown-item">{{ __('Contacted') }}</button>
                                                    <button type="submit" name="status" value="converted" class="dropdown-item">{{ __('Converted') }}</button>
                                                    <button type="submit" name="status" value="closed" class="dropdown-item">{{ __('Closed') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection