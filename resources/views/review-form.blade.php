<!-- Review Form Creation -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Social links -->
            <ul>
                <li><a href="#" target="_blank">Facebook</a></li>
                <li><a href="#" target="_blank">LinkedIn</a></li>
            </ul>
        </div>
        <div class="col-md-8">
            <h2>Review Form</h2>
            <form method="POST" action="#">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>