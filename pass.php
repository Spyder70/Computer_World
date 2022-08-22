<!doctype html>
                        <html lang="en">
                        
                        <head>
                          <title>Password Validation</title>
                          <!-- Required meta tags -->
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        
                          <!-- Bootstrap CSS -->
                          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        
                          <link rel="stylesheet" href="pass.css">
                        </head>
                        
                        <body>
                        
                        
                        
                          <div class="main">
                        
                            <div class="container">
                        
                        
                              <div class="row">
                                <div class="col-12">
                                  <form action="#">
                        
                                    <h1>Password Validation
                                      <hr>
                                      
                        
                                    <div class="form-group">
                                      <label for="usrname">Username</label>
                                      <input type="text" class="form-control" id="usrname" name="usrname" required>
                        
                                    </div>
                                    <div class="form-group">
                                      <label for="psw">Password</label>
                                      <input type="password" class="form-control" id="psw" name="psw"
                                        pattern="(?=.*/d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must Contain at least one number one uppercase and lowercase letter, and at least 8 or more characters"
                                        required>
                        
                                      <span toggle="#psw" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                        
                                    <button type="submit" value="submit" class="btn btn-submit">Submit</button>
                                  </form>
                        
                        
                                     <div id="validation_box">
                        
                                        <h4>Password Must Contain The Following</h4>
                        
                                        <p id="letter" class="invalid">Lowercase Letters</p>
                                        <p id="capital" class="invalid">Uppercase Letters</p>
                                        <p id="number" class="invalid">A Number</p>
                                        <p id="length" class="invalid">Atleast 8 Characters</p>
                        
                                  </div>
                        
                                </div>
                              </div>
                        
                            </div>
                        
                        
                          </div>
                        
                          <!-- Optional JavaScript -->
                          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
                          </script>
                          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
                          </script>
                          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
                          </script>
                          <script src="pass.js"></script>
                        
                        </body>
                        
                        </html>