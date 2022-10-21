
<h2> MOSTRAMOS EL PERFIL Y AGREGAMOS BOTON "CHANGE MY PROFILE" QUE REDIRIJA A User/ShowModifyUserProfile (controladora de User, metodo ModifyUserProfile) </h2>

          <table style="text-align:center;">
            <thead>
              <tr>
                <th style="width: 100px;">Codigo</th>
                <th style="width: 170px;">Nombre</th>
                <th style="width: 120px;">Tipo</th>
                <th style="width: 400px;">Descripcion</th>
                <th style="width: 110px;">Dens. Alcohol</th>                
                <th style="width: 120px;">Precio $ </th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                      <td><?php echo $beer->getCode() ?></td>
                      <td><?php echo $beer->getName() ?></td>
                      <td><?php echo $beer->getBeerType()->getName() ?></td>
                      <td><?php echo $beer->getDescription() ?></td>
                      <td><?php echo $beer->getDensity() ?></td>
                      <td><?php echo $beer->getPrice() ?></td>
                    </tr>                        
            </tbody>
          </table>
          <button type="buton" action ></button> <--------------------------------------- MODIFICAR