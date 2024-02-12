<div class="col-lg-6">
    <div class="test-section">
        <p>Select the test you would like to take from the options below:</p>
        <ul class="test-list">
            <li class="custom-dropdown" id="cetDropdownContainer">
                <span class="test-list-item">CET Form Applications<span class="dropdown-indicator">&#9662;</span></span>
                <ul class="dropdown-content" id="cetDropdown" style="list-style-type: none;">
                    <li wire:click="undergrad()"><a href="#" >CET SHS Graduating form</a></li>
                    <li wire:click="grad()"><a href="#">CET SHS Graduate form</a></li>
                    <li wire:click="shiftee_tranferee()"><a href="#">CET Shiftee/Transferee</a></li>
                </ul>
            </li>
            <li>
                <a class="test-list-item" href="{{ Route('student.cet.nat') }}">
                    NAT Application
                    <button class="btn btn-primary apply-button">Available</button>
                </a>
            </li>
            <li>
                <a class="test-list-item" href="{{ Route('student.cet.eat') }}">
                    EAT Application
                    <button class="btn btn-primary apply-button">Available</button>
                </a>
            </li>
            <li>
                <a class="test-list-item" href="{{ url('test-application.Gsat') }}">
                    GSAT Application
                    <button class="btn btn-primary apply-button">Unavailabe</button>
                </a>
            </li>
            <li>
                <a class="test-list-item" href="{{ url('test-application.Lsat') }}">
                    LSAT Application
                    <button class="btn btn-primary apply-button">Unavailabe</button>
                </a>
            </li>
        </ul>
    </div>
</div>