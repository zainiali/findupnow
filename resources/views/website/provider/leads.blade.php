@extends('website.provider.master_layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
            </div>

            <!-- Stats Cards -->
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('New Leads') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $new_leads_count }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Contacted') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $contacted_leads_count }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Converted') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $converted_leads_count }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form method="GET">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>{{ __('Lead ID') }}</label>
                                        <input class="form-control" name="lead_id" type="text" 
                                            value="{{ request()->get('lead_id') }}" 
                                            placeholder="{{ __('Search by Lead ID') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        <select class="form-control" name="status">
                                            <option value="all" {{ request()->get('status') == 'all' ? 'selected' : '' }}>{{ __('All') }}</option>
                                            <option value="new" {{ request()->get('status') == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                            <option value="contacted" {{ request()->get('status') == 'contacted' ? 'selected' : '' }}>{{ __('Contacted') }}</option>
                                            <option value="converted" {{ request()->get('status') == 'converted' ? 'selected' : '' }}>{{ __('Converted') }}</option>
                                            <option value="closed" {{ request()->get('status') == 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary plus_btn" style="margin-top: 30px;">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Leads List -->
            <div class="section-body">
                <div class="row">
                    @if ($leads->count() > 0)
                        @foreach ($leads as $lead)
                            <div class="col-12">
                                <div class="card service_card order_card">
                                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="service_detail" style="flex: 1;">
                                            <div class="d-flex align-items-center mb-2">
                                                <h4 class="mb-0">{{ ucfirst(str_replace('-', ' ', $lead->category->slug ?? 'Service')) }}</h4>
                                                <span class="badge {{ $lead->status_badge }} ml-3">{{ $lead->formatted_status }}</span>
                                            </div>
                                            
                                            <p><strong>{{ __('Lead ID') }}:</strong> {{ $lead->lead_id }}</p>
                                            <p><strong>{{ __('Service Type') }}:</strong> {{ $lead->service_type }}</p>
                                            <p><strong>{{ __('Location') }}:</strong> {{ $lead->zip_code }}
                                                @if($lead->location_city), {{ $lead->location_city }}@endif
                                                @if($lead->location_state), {{ $lead->location_state }}@endif
                                            </p>
                                            <p><strong>{{ __('Received') }}:</strong> {{ $lead->created_at->format('M d, Y h:i A') }}</p>
                                            
                                            @if($lead->additional_details)
                                                <p><strong>{{ __('Details') }}:</strong> {{ \Illuminate\Support\Str::limit($lead->additional_details, 100) }}</p>
                                            @endif

                                            <div class="mt-3">
                                                <a class="btn btn-primary btn-sm" href="{{ route('provider.leads.show', $lead->lead_id) }}">
                                                    <i class="fas fa-eye"></i> {{ __('View Details') }}
                                                </a>

                                                @if($lead->status === 'new')
                                                    <form action="{{ route('provider.leads.contacted', $lead->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="fas fa-phone"></i> {{ __('Mark as Contacted') }}
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($lead->status === 'contacted')
                                                    <form action="{{ route('provider.leads.converted', $lead->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="fas fa-check"></i> {{ __('Mark as Converted') }}
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center text-danger">
                            <h4>{{ __('No leads found!') }}</h4>
                        </div>
                    @endif

                    <div class="col-12">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection