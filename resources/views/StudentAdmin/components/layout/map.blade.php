,<style>
#map {
    height: 400px;
    width: 100%;
}
.coordinates {
    margin-top: 10px;
}
.range-slider {
        display: flex;
        align-items: center;
    }
    .range-slider input {
        margin-left: 10px;
        flex: 1;
    }
</style>
@include('Admin.components.adminstyle')

<div class="modal modal-blur fade" id="eventSettings" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Event Setting</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

                              <div class="table-responsive">
                                <table id="Venuetable" class="table table-striped" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th style="width: 55%">Venue</th>
                                      <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   
                                  </tbody>
                                </table>
                              </div>
                              <br>
                              {{-- table end --}}
                              {{-- map --}}
                              <div id="map">Loading map...</div>

                              <button type="button" class="btn btn-primary col-12" onclick="refreshLocation()">Refresh Location</button>
                                <form action="" class="" id="eventlocationForm" method="post">
                                    @csrf
                                    <br>
                                    <div class="range-slider">
                                        <label for="rangeRadius">Range Radius (meters):</label>
                                        <input type="range" id="rangeRadius" name="rangeRadius" min="10" max="500" step="20" value="100" oninput="updateRadius(this.value)">
                                        <span id="rangeValue">500</span> meters
                                    </div>
                                    <br>
                                    <input type="text" id="lat" name="lat" readonly hidden>
                                    <input type="text" id="lng" name="lng" readonly hidden>
                                    <div class="row g-2">
                                    <div class="col-12">
                                        <label for="adminuser" class="form-label">Venue</label>
                                        <input type="text" class="form-control" name="venue" id="venue">
                                        <input type="text" class="form-control" name="venueID" id="venueID" hidden>
                                      </div>
                                    </div>
                                    <br>
                                      <button type="button" class="btn btn-primary" id='newVenue' onclick="dynamicFuction('eventlocationForm','{{ route('SubmitEventVenue') }}')">Add Venue</button>
                                      <button type="button" class="btn btn-primary"id='updateVenue' style="display:none;" onclick="dynamicFuction('eventlocationForm','{{ route('updateVenue') }}')">Update</button>

                                </form>
                                <form id="deleteVenueForm" method="post" style="display: none">
                                  @csrf
                                  <input type="text" name="v_id" id="v_id">
                                </form>
                              {{-- end map --}}
                           