<!doctype html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>dashboard admin</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <style>
      body {
        opacity: 0;
      }
    </style>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">
        <!--include sidebar code-->
@include('inc.admin.sidebar')

 <!--include navbar code-->
@include('inc.admin.navbar')
        <div class="content">
          <div class="pb-5">
            <div class="row g-5">
                <div>
                    <h1 class="text-center">liste produits</h1>
                </hr>
                   <a href="" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">ajouter produit</a>
                   <div class="mt-3">
                     <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom produit</th>
                        <th scope="col">description produit </th>
                        <th scope="col">prix produit </th>
                        <th scope="col">quantity produit </th>
                        <th scope="col">image produit </th>
                        <th scope="col">action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $index=>$p )
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->description }}</td>
                        <td>{{ $p->price }}</td>
                        <td>{{ $p->qte }}</td>
                        <td>
                            <img src="{{ asset('uploads') }}/{{ $p->photo }}" width="150">
                        </td>
                        <td>
                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProduct{{ $p->id }}">modifier</a>
                            <a class="btn btn-outline-danger" onclick="return confirm('voulez-vous vraiment supprimer cette produit ?')"  href="/admin/produit/{{$p->id}}/delete">supprimer</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                   </table>
                   </div>

                </div>
                </div>
            </div>
          </div>

          <footer class="footer">
            <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-900">Thank you for creating with phoenix<span class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v1.1.0</p>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </main>

    <!-- Modal ajouter-->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title" id="exampleModalLabel">ajouter produit</h5></h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                            </div>
                            <form action="/admin/produit/store" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">categorie produit</label>

                                   <select class="form-control" name="categorie">
                                     @foreach ($categories as $c )
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                   </select>
                                    @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>

                                    @enderror
                                  </div>




                                     <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Nom produit</label>
                                    <input name="name" class="form-control" id="exampleFormControlInput1" type="text" placeholder="taper nom produit">
                                    @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>

                                    @enderror
                                  </div>

                                  <div class="mb-0">
                                    <label class="form-label" for="exampleTextarea">description produit </label>
                                    <textarea name="description" class="form-control" id="exampleTextarea" rows="3"> </textarea>
                                    @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                  </div>

                                  <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">prix produit</label>
                                    <input name="price" class="form-control" id="exampleFormControlInput1" type="number" placeholder="prix produit">
                                    @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                  </div>

                                  <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">quantity produit</label>
                                    <input name="qte" class="form-control" id="exampleFormControlInput1" type="number" placeholder="quantity produit">
                                    @error('qte')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">photo produit</label>
                                    <input name="photo" class="form-control" id="exampleFormControlInput1" type="file">
                                    @error('photo')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                  </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Okay</button>
                                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
      <!--  modal edit-->

      @foreach ($produits as $index=>$p )
<div class="modal fade" id="editProduct{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">modifier produit</h5></h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
        </div>
        <form action="/admin/produit/update" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <input type="hidden" name="idproduit" value="{{ $p->id }}">
            <img src="{{ asset('uploads') }}/{{ $p->photo }}" width="150">


            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">categorie produit</label>
               <select name="categorie" class="form-control" value="{{ $c->categorie }}">
                @foreach ($categories as $c )
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
               </select>
                @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>

                @enderror
              </div>


                 <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nom produit</label>
                <input name="name" class="form-control" id="exampleFormControlInput1" type="text" placeholder="taper nom produit" value="{{ $p->name }}">
                @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>

                @enderror
              </div>

              <div class="mb-0">
                <label class="form-label" for="exampleTextarea">description produit </label>
                <textarea name="description" class="form-control" id="exampleTextarea" rows="3" >{{ $p->description }} </textarea>
                @error('description')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">prix produit</label>
                <input name="price" class="form-control" id="exampleFormControlInput1" type="number" placeholder="prix produit" value="{{ $p->price }}">
                @error('price')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">quantity produit</label>
                <input name="qte" class="form-control" id="exampleFormControlInput1" type="number" placeholder="quantity produit" value="{{ $p->qte }}">
                @error('qte')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">photo produit</label>
                <input name="photo" class="form-control" id="exampleFormControlInput1" type="file">
                @error('photo')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>


        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">modifier</button>
            <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  @endforeach
    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashboard/js/ecommerce-dashboard.js') }}"></script>
  </body>

</html>

