<!-- CALENDARIO DE CURSOS -->
<section class="calendar-section">
    <div class="calendar-container">
        <div class="calendar-header">
            <img src="{{ asset('images/flecha-azulclaro-rellena.svg') }}" alt="" class="doctor-detail__block-arrow">
            <div class="calendar-title-wrapper">
                <h2 class="calendar-title">Upcoming Courses</h2>
                <p class="calendar-subtitle">Find the perfect date for your training</p>
            </div>
            <div class="calendar-legend">
                <button class="legend-item active" data-filter="all">
                    <span class="legend-dot legend-dot--all"></span>
                    All
                </button>
                <button class="legend-item active" data-filter="peru">
                    <span class="legend-dot legend-dot--peru"></span>
                    Perú
                </button>
                <button class="legend-item active" data-filter="cuba">
                    <span class="legend-dot legend-dot--default"></span>
                    Cuba
                </button>
            </div>
        </div>

        <div class="calendar-wrapper">
            <div id="coursesCalendar"></div>
        </div>

        <!-- Tooltip para mostrar info al hover -->
        <div id="calendarTooltip" class="calendar-tooltip">
            <div class="tooltip-content">
                <h4 class="tooltip-title"></h4>
                <p class="tooltip-location"></p>
                <p class="tooltip-spots"></p>
            </div>
        </div>
    </div>
</section>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<style>
    /* Vista anual compacta */
    .fc-multimonth {
        border: none !important;
        font-size: 0.7rem;
    }

    .fc-multimonth-month {
        padding: 0.2em 0.3em;
        border: none !important;
    }

    .fc-multimonth-header {
        background: transparent;
    }

    .fc-multimonth-title {
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.3em 0;
    }

    /* Celdas compactas */
    .fc-multimonth .fc-daygrid-day {
        min-height: auto !important;
        border-color: #f0f0f0;
    }

    .fc-multimonth .fc-daygrid-day-frame {
        min-height: 1.8em !important;
        padding: 0 !important;
    }

    .fc-multimonth .fc-daygrid-day-top {
        font-size: 0.7rem;
        padding: 0;
        justify-content: center;
    }

    .fc-multimonth .fc-col-header-cell {
        font-size: 0.65rem;
        padding: 0.15em 0;
    }

    /* Eventos */
    .fc-multimonth .fc-daygrid-event-harness {
        margin: 0 !important;
    }

    .fc-multimonth .fc-event,
    .fc-multimonth .fc-daygrid-event {
        font-size: 0.7rem !important;
        line-height: 1.4 !important;
        padding: 2px 5px !important;
        margin: 1px 0 !important;
        border-radius: 3px !important;
        min-height: 18px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        display: flex !important;
        align-items: center !important;
    }

    .fc-multimonth .fc-event *,
    .fc-multimonth .fc-daygrid-event * {
        font-size: 0.7rem !important;
        line-height: 1.4 !important;
        color: #fff !important;
    }

    .fc-multimonth .fc-event .fc-event-time {
        display: none !important;
    }

    .fc-multimonth .fc-event .fc-event-title {
        display: inline !important;
        font-size: 0.9rem !important;
    }

    /* Soporte para dot-events */
    .fc-multimonth .fc-daygrid-dot-event {
        padding: 2px 5px !important;
        background-color: var(--fc-event-bg-color, #3788d8) !important;
        border-radius: 3px !important;
        display: flex !important;
        align-items: center !important;
    }

    .fc-multimonth .fc-daygrid-dot-event .fc-event-title {
        display: inline !important;
        font-size: 0.7rem !important;
        color: #fff !important;
    }

    .fc-multimonth .fc-daygrid-dot-event .fc-daygrid-event-dot {
        display: none !important;
    }

    .fc-multimonth .fc-daygrid-bg-harness {
        display: block;
    }

    .fc-multimonth .fc-daygrid-more-link {
        font-size: 0.65rem;
    }

    /* Leyenda interactiva */
    .calendar-legend {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.75rem;
        border: 1px solid #ddd;
        border-radius: 20px;
        background: #fff;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        font-family: inherit;
        color: #666;
    }

    .legend-item:hover {
        border-color: #aaa;
    }

    .legend-item.active {
        color: #333;
        border-color: #999;
        background: #f5f5f5;
    }

    .legend-item:not(.active) {
        opacity: 0.45;
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    /* Toda la barra del evento es clickable */
    .fc-multimonth .fc-event,
    .fc-multimonth .fc-daygrid-event {
        cursor: pointer !important;
    }

    .fc-multimonth .fc-event a,
    .fc-multimonth .fc-daygrid-event a {
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        height: 100% !important;
        text-decoration: none !important;
        color: #fff !important;
    }

    .fc-multimonth .fc-event,
    .fc-multimonth .fc-daygrid-event,
    .fc-multimonth .fc-event-main {
        cursor: pointer !important;
    }

    /* Responsive */
    @media (max-width: 1023px) {
        .fc-multimonth {
            font-size: 0.65rem;
        }
        .fc-multimonth-title {
            font-size: 0.8rem;
        }
        .fc-multimonth .fc-event,
        .fc-multimonth .fc-daygrid-event {
            font-size: 0.65rem !important;
        }
    }

    @media (max-width: 767px) {
        .fc-multimonth {
            font-size: 0.6rem;
        }
        .fc-multimonth-title {
            font-size: 0.75rem;
        }
        .fc-multimonth .fc-event,
        .fc-multimonth .fc-daygrid-event {
            font-size: 0.6rem !important;
            min-height: 16px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('coursesCalendar');
    const tooltip = document.getElementById('calendarTooltip');
    const legendButtons = document.querySelectorAll('.legend-item[data-filter]');

    let activeFilters = new Set(['peru', 'cuba']);
    let allEvents = [];

    function getLocationKey(location) {
        if (!location) return 'cuba';
        const loc = location.toLowerCase();
        if (loc.includes('peru') || loc.includes('perú')) return 'peru';
        return 'cuba';
    }

    function applyFilters() {
        calendar.removeAllEvents();
        const filtered = allEvents.filter(ev => {
            const loc = ev.extendedProps?.location || '';
            return activeFilters.has(getLocationKey(loc));
        });
        calendar.addEventSource(filtered);
    }

    legendButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            if (filter === 'all') {
                if (activeFilters.size === 2) {
                    activeFilters.clear();
                } else {
                    activeFilters = new Set(['peru', 'cuba']);
                }
            } else {
                if (activeFilters.has(filter)) {
                    activeFilters.delete(filter);
                } else {
                    activeFilters.add(filter);
                }
            }

            legendButtons.forEach(b => {
                const f = b.dataset.filter;
                if (f === 'all') {
                    b.classList.toggle('active', activeFilters.size === 2);
                } else {
                    b.classList.toggle('active', activeFilters.has(f));
                }
            });

            applyFilters();
        });
    });

    // Cargar eventos manualmente via fetch
    fetch('/api/calendar/events')
        .then(res => res.json())
        .then(data => {
            allEvents = data.map(ev => {
                // Mover url a extendedProps y eliminarla del evento
                if (ev.url) {
                    if (!ev.extendedProps) ev.extendedProps = {};
                    ev.extendedProps.courseUrl = ev.url;
                    delete ev.url;
                }
                return ev;
            });
            calendar.addEventSource(allEvents);
        })
        .catch(err => console.error('Error loading calendar events', err));

        const now = new Date();
        const currentMonth = now.getMonth(); // 0-11
        const remainingMonths = 12 - currentMonth; // meses hasta fin de año

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'multiMonth',
            duration: { months: 9 },        // abril a diciembre = 9 meses
            initialDate: '2026-04-01',
            height: 'auto',
            locale: 'en',
            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },
            firstDay: 1,
            fixedWeekCount: false,
            multiMonthMaxColumns: 3,

        // SIN events aquí - los cargamos manualmente arriba

        eventClick: function(info) {
            info.jsEvent.preventDefault();
            const courseUrl = info.event.extendedProps.courseUrl;
            if (courseUrl) {
                window.location.href = courseUrl;
            }
        },

        eventMouseEnter: function(info) {
            const props = info.event.extendedProps;
            tooltip.querySelector('.tooltip-title').textContent = info.event.title;
            tooltip.querySelector('.tooltip-location').textContent = '📍 ' + props.location;
            tooltip.querySelector('.tooltip-spots').textContent = props.spots + ' spots available';

            const rect = info.el.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) + 'px';
            tooltip.style.top = (rect.top - 10 + window.scrollY) + 'px';
            tooltip.style.position = 'absolute';
            tooltip.classList.add('visible');
        },

        eventMouseLeave: function() {
            tooltip.classList.remove('visible');
        },

        windowResize: function() {
            if (window.innerWidth < 768) {
                calendar.setOption('multiMonthMaxColumns', 1);
            } else if (window.innerWidth < 1024) {
                calendar.setOption('multiMonthMaxColumns', 2);
            } else {
                calendar.setOption('multiMonthMaxColumns', 3);
            }
        }
    });

    calendar.render();

    if (window.innerWidth < 768) {
        calendar.setOption('multiMonthMaxColumns', 1);
    } else if (window.innerWidth < 1024) {
        calendar.setOption('multiMonthMaxColumns', 2);
    }
});
</script>
@endpush