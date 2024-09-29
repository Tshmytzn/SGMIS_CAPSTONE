<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/evo-calendar.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#calendar").evoCalendar({
            theme: 'Royal Navy',
            calendarEvents: [
                {
                    id: 'bHay68s',
                    name: "New Year",
                    date: "January/1/2020",
                    type: "holiday",
                    everyYear: true
                },
                {
                    name: "Vacation Leave",
                    badge: "02/13 - 02/15",
                    date: ["February/13/2020", "February/15/2020"],
                    description: "Vacation leave for 3 days.",
                    type: "event",
                    color: "#63d867"
                }
            ]
        });
    });
</script>

<script src="{{ asset('./dist/js/tabler.min.js?1684106062') }}" defer></script>
<script src="{{ asset('./dist/js/demo.min.js?1684106062') }}" defer></script>
<script src="{{asset('./dist/libs/nouislider/dist/nouislider.min.js?1684106062')}}" defer></script>
<script src="{{asset('./dist/libs/litepicker/dist/litepicker.js?1684106062')}}" defer></script>
<script src="{{asset('./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062')}}" defer></script>
