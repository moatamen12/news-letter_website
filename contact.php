<?php 
    require_once 'includes/header.php';
?>

    <section class="container py-5 my-5">
        <div class="row justify-content-center shadow-lg">
            <div class="col-md-8 text-center">
                <h2 class="display-4">Get in Touch</h2>
                <p class="lead mb-5">Have questions? any complains or any Suggestion! <br> We'd love to hear from you </p>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="your@email.com">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
                    </div>

                    <div class="mb-3 d-flex">
                        <button type="submit" class="btn w-100 btn-subscribe">Send Message</button>
                        <button type="submit" class="btn w-100 mx-2 btn-danger">Cansel</button>
                        <button type="submit" class="btn w-100 btn btn-warning">Rewrite</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php 
    require_once 'includes/footer.php';
?>  