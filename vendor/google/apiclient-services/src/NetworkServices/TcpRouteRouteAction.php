<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\NetworkServices;

class TcpRouteRouteAction extends \Google\Collection
{
  protected $collection_key = 'destinations';
  protected $destinationsType = TcpRouteRouteDestination::class;
  protected $destinationsDataType = 'array';
  /**
   * @var bool
   */
  public $originalDestination;

  /**
   * @param TcpRouteRouteDestination[]
   */
  public function setDestinations($destinations)
  {
    $this->destinations = $destinations;
  }
  /**
   * @return TcpRouteRouteDestination[]
   */
  public function getDestinations()
  {
    return $this->destinations;
  }
  /**
   * @param bool
   */
  public function setOriginalDestination($originalDestination)
  {
    $this->originalDestination = $originalDestination;
  }
  /**
   * @return bool
   */
  public function getOriginalDestination()
  {
    return $this->originalDestination;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TcpRouteRouteAction::class, 'Google_Service_NetworkServices_TcpRouteRouteAction');
